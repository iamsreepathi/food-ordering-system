<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCart;
use App\Models\MenuItem;
use App\Services\CartService;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{

    public function __construct(private CartService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = $this->service->getCart();
        return Inertia::render('Cart', [
            'items' => $cart->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddToCart $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddToCart $request, string $id)
    {
        $item = MenuItem::find($id);
        if (!$item) throw new NotFoundHttpException('Item not found.');
        $this->service->addToCart($item, $request, true);
        session()->flash('message', 'Cart updated successfully');
        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->deleteFromCart((int) $id);
        session()->flash('message', 'Cart updated successfully');
        return redirect()->route('cart.index');
    }

    public function add($id, AddToCart $request)
    {
        $item = MenuItem::find($id);
        if (!$item) throw new NotFoundHttpException('Item not found.');
        $this->service->addToCart($item, $request);
        return redirect()->route('cart.index');
    }
}
