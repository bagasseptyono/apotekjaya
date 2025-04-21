<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'payment_method',
        'payment_image',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class);
    }

    public function getPaymentMethodTextAttribute()
    {
        return match ($this->payment_method) {
            1 => 'Transfer Bank',
            2 => 'COD',
            default => 'Tidak Diketahui',
        };
    }
}
