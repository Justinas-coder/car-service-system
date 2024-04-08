<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\StripeCheckoutService;
use App\Services\StripeWebHookService;
use Illuminate\Http\Request;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{
    protected $checkoutService;

    public function __construct(StripeCheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function index(Order $order)
    {
        return view('cart.index', [
            'order' => $order
        ]);
    }

    public function checkout(Order $order)
    {
        $checkoutUrl = $this->checkoutService->processCheckout($order);

        return redirect($checkoutUrl);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        try {
            $customer = $this->checkoutService->markOrderAsPaid($sessionId);

            return view('payment.checkout-success', compact('customer'));

        } catch (\Throwable) {
            throw new NotFoundHttpException();
        }
    }

    public function webhook()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = config('services.stripe.webhook_key');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException|SignatureVerificationException $e) {
            // Invalid payload
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
                break;

            // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}
