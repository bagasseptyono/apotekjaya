<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'price',
        'description',
        'category_id',
        'image'
    ];

    public function order_details(): HasMany{
        return $this->hasMany(OrderDetail::class);
    }

    public function carts(): HasMany{
        return $this->hasMany(Cart::class);
    }

    public function itemCategory() {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }
}
