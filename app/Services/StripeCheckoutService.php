<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StripeCheckoutService
{

    protected StripeClient $stripe;
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.key'));

        $this->stripe = new StripeClient(config('services.stripe.key'));
    }

    public function processCheckout(Order $order)
    {
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

        $checkout_session = $this->stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('cart.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('cart.cancel', [], true),
            'customer_creation' => 'always'
        ]);

        $order->session_id = $checkout_session->id;
        $order->save();

        return $checkout_session->url;
    }

    public function markOrderAsPaid($sessionId)
    {
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);
        if (!$session) {
            throw new NotFoundHttpException;
        }
        $customer = $this->stripe->customers->retrieve($session->customer);

        $order = Order::where('session_id', $session->id)->firstOrFail();

        if ($order->status === OrderStatus::NOT_PAID) {
            $order->status = OrderStatus::COMPLETED;
            $order->save();
        }

        return $customer;
    }
}
