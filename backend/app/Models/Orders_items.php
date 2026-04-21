<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders_items extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];


    // Relacion con Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
