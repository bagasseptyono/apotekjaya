<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemCategory extends Model
{
    public $fillable = [
        'name',
        'image'
    ];

    public function item():HasMany {
        return $this->hasMany(Product::class);
    }
}
