<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class);
    }

    public function scopeFeatured(Builder $query)
    {
        return $query->select('id', 'name', 'price', 'short_description', 'image_url')
            ->where('featured', 1)
            ->limit(5);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(MenuRating::class, 'menu_item_id');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_item')->using(OrderItem::class);
    }

    /**
     * Get the user's first name.
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
        );
    }
}
