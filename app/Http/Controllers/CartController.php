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
use Symfony\Component\HttpFoundation\Response;
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
}
