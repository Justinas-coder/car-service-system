<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{
    public function index(Order $order)
    {
        return view('cart.index', [
            'order' => $order
        ]);
    }

    public function checkout(Order $order)
    {
        Stripe::setApiKey(config('services.stripe.key'));

        $stripe = new StripeClient(config('services.stripe.key'));

        $lineItems = [];

        foreach ($order->services as $service) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $service->name,
                    ],
                    'unit_amount' => $service->price * 100,
                ],
                'quantity' => 1,
            ];
        }

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('cart.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('cart.cancel', [], true),
            'customer_creation' => 'always'
        ]);

        $order->session_id = $checkout_session->id;
        $order->save();

        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.key'));

        $sessionId = $request->get('session_id');

        try {
            $session = $stripe->checkout->sessions->retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }
            $customer = $stripe->customers->retrieve($session->customer);

            $order = Order::where('session_id', $session->id)->first();
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->status === OrderStatus::NOT_PAID) {
                $order->status = OrderStatus::COMPLETED;
                $order->save();
            }

            return view('payment.checkout-success', compact('customer'));

        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
    }

    public function cancel()
    {

    }

    public function webhook()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_ET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

// Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $sessionId = $session->id;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->status === OrderStatus::NOT_PAID) {
                    $order->status = OrderStatus::COMPLETED;
                    $order->save();
                }

            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');


    }
}
