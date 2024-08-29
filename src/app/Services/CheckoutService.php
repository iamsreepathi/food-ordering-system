<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;

class CheckoutService
{
    public function __construct(private CartService $cart)
    {
    }

    public function emptyCart()
    {
        return $this->cart->empty();
    }

    public function items()
    {
        return $this->cart->getCart()->all();
    }

    public function lineItems()
    {
        return $this->cart->lineItems();
    }

    public function createOrder(User $user, $params)
    {
        $cart = $this->cart->getCart();
        $total = $this->cart->total($cart);

        $order = new Order();
        $order->user_id = $user->id;
        $order->total_amount = $total * 100;
        $order->silverware = $params['silverware'];
        $order->instructions = $params['instructions'];
        $order->self_pickup = $params['pickup'];
        $order->save();

        $orderItems = $cart->reduce(function (array $carry, $item) use ($order) {
            $carry[$item['item']->id] =  [
                'quantity' => $item['quantity'],
                'unit_price' => $item['item']->price * 100
            ];
            return $carry;
        }, []);

        $order->items()->attach($orderItems);
        return $order;
    }

    public function stripeCheckout(User $user, Order $order)
    {
        $items = $this->lineItems();
        return $user->checkout($items, [
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel') . '?order=' . $order->id,
            'mode' => 'payment',
            'billing_address_collection' => 'required',
            'phone_number_collection' => [
                'enabled' => true
            ],
            'metadata' => [
                'order' => $order->id
            ]
        ]);
    }

    public function payment($session)
    {
        $orderId = $session->metadata->order;
        $order = Order::find($orderId);
        $order->status = OrderStatus::Received;
        $order->payment_intent = $session->payment_intent;
        $order->billing_address = $session->customer_details->address;
        $order->save();

        $this->cart->setCart(collect());
        return $order;
    }
}
