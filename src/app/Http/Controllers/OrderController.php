<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $orders = $user->orders()->where('status', '!=', 'Pending')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Orders', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        $order->load('items');
        return Inertia::render('Order', [
            'order' => $order
        ]);
    }
}
