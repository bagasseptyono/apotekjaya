<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'total',
    ];

    public function order(): BelongsTo{
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class, 'product_id');
    }
}
