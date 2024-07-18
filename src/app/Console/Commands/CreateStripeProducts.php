<?php

namespace App\Console\Commands;

use App\Models\MenuItem;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Stripe\StripeClient;

class CreateStripeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:create-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command stripe products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $secret = config('cashier.secret');
        $stripe = new StripeClient($secret);
        MenuItem::chunk(100, function (Collection $items) use ($stripe) {
            foreach ($items as $item) {
                // Create stripe product
                $product = $stripe->products->create([
                    'name' => $item->name,
                    'description' => $item->description,
                ]);
                $productId = $product->id;

                $this->info("Stripe product {$productId} created.");
                // Create stripe price
                $price = $stripe->prices->create([
                    'unit_amount' => $item->price * 100,
                    'currency' => 'usd',
                    'product' => $productId,
                ]);
                $this->info("Stripe price for product {$productId} {$price->id} created.");

                $item->price_id = $price->id;
                $item->save();
                $this->info("Menu item {$productId} updated with stripe price id {$price->id}.");
            }
        });
    }
}
