<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $orders = $user->orders()->where('status', '!=', OrderStatus::Pending)->orderBy('created_at', 'desc')->get();
        return Inertia::render('Orders', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order, Request $request)
    {
        $user = $request->user();
        if ($user->id != $order->user_id || $order->status === OrderStatus::Pending) throw new NotFoundHttpException('Order not found.');
        $order->load('items');
        return Inertia::render('Order', [
            'order' => $order
        ]);
    }
}
