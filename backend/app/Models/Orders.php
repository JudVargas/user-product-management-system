<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'user_id',
        'total',
    ];

    // Relacion con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacion con OrderItem
    public function items()
    {
        return $this->hasMany(Orders_items::class, 'order_id');
    }
}
