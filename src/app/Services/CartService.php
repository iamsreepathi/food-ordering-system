<?php

namespace App\Services;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class CartService
{
    const TAX_PERCENT = 6;

    public function getCart(): Collection
    {
        return Session::get('cart', collect());
    }

    public function setCart(Collection $cart)
    {
        Session::put('cart', $cart);
    }

    public function empty()
    {
        $cart = $this->getCart();
        return $cart->count() <= 0;
    }

    public function getCartItem(MenuItem $item, $quantity, $instructions)
    {
        return [
            'item' => $item,
            'quantity' => $quantity,
            'instructions' => $instructions
        ];
    }

    public function updateCart(MenuItem $item, Collection $items, int $quantity, mixed $instructions, $replace)
    {
        $cartItem = $items->first(fn ($val) => $val['item']->id === $item->id);
        if (!$cartItem) $items->push($this->getCartItem($item, $quantity, $instructions));
        else {
            $items = $items->map(function ($i) use ($item, $quantity, $instructions, $replace) {
                if ($i['item']->id === $item->id) {
                    $qty = $replace ? $quantity : $i["quantity"] + $quantity;
                    $i = $this->getCartItem($item, $qty, $instructions);
                }
                return $i;
            });
        }
        return $items;
    }

    public function addToCart(MenuItem $item, Request $request, $replace = false)
    {
        $qty = $request->get('quantity', 1);
        $inst = $request->get('instructions', null);
        $cart = $this->getCart();
        $updatedCart = $this->updateCart($item, $cart, $qty, $inst, $replace);
        $this->setCart($updatedCart);
    }

    public function deleteFromCart(int $id)
    {
        $cart = $this->getCart();
        $filtered = $cart->reject(fn ($i) => $i['item']->id === $id);
        $this->setCart($filtered);
    }

    public function lineItems()
    {
        $cart = $this->getCart();
        return $cart->reduce(function (array $carry, $item) {
            $carry[$item['item']->price_id] = $item['quantity'];
            return $carry;
        }, []);
    }

    public function tax($subTotal)
    {
        return ($subTotal * self::TAX_PERCENT) / 100;
    }

    public function total(Collection $cart)
    {
        $subTotal = $cart->sum(function (array $item) {
            return $item['item']->price * $item['quantity'];
        });
        $tax = $this->tax($subTotal);
        return $tax + $subTotal;
    }
}
