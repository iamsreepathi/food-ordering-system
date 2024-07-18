<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class CheckoutController extends Controller
{

    public function __construct(private CheckoutService $checkout)
    {
    }

    public function index(Request $request)
    {
        $empty = $this->checkout->emptyCart();
        if ($empty) return redirect()->route('cart.index');
        $items = $this->checkout->items();
        return Inertia::render('Checkout', [
            'items' => $items
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $empty = $this->checkout->emptyCart();
        if ($empty) return redirect()->route('cart.index');
        $user = $request->user();
        $order = $this->checkout->createOrder($user, $request->validated());
        $session = $this->checkout->stripeCheckout($user, $order);
        return Inertia::location($session->url);
    }

    public function success(Request $request)
    {
        $user = $request->user();
        $session = $user->stripe()->checkout->sessions->retrieve($request->get('session_id'));
        $order = $this->checkout->payment($session);
        Mail::to($user->email)->queue((new OrderConfirmation($order))->onQueue('orders'));
        return redirect()->route('orders.show', ['order' => $order->id]);
    }

    public function cancel(Request $request)
    {
        $orderId = (int) $request->get('order');
        if ($orderId) Order::where([
            'id' => $orderId,
            'status' => 'Pending'
        ])->delete();
        return redirect()->route('checkout.index');
    }
}
