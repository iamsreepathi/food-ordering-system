<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemRatingRequest;
use App\Http\Resources\MenuRatingResource;
use App\Models\MenuItem;
use App\Models\MenuRating;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        $ratings = MenuRatingResource::collection(MenuRating::with('user:id,name')
            ->where('menu_item_id', $menuItem->id)
            ->select('id', 'rating', 'review', 'created_at', 'user_id')
            ->cursorPaginate(10));

        return Inertia::render('MenuItem', [
            'item' => $menuItem,
            'ratings' => $ratings,
            'maxRating' => 5
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menuItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menuItem)
    {
        //
    }

    /**
     * Menu item rating by the customer.
     */
    public function review(MenuItem $menuItem, MenuItemRatingRequest $request)
    {
        MenuRating::upsert(
            [
                [
                    'user_id' => $request->user()->id,
                    'menu_item_id' => $menuItem->id,
                    'rating' => $request->get('rating'),
                    'review' => $request->get('review')
                ],
            ],
            ['user_id', 'menu_item_id'],
            ['rating', 'review']
        );
        session()->flash('message', 'Your review submitted. Thank you!');
    }
}
