<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'component_id', 'quantity', 'price_per_item', 'subtotal',
    ];

    protected $casts = [
        'price_per_item' => 'decimal:2',
        'subtotal'       => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function component()
    {
        return $this->belongsTo(Component::class);
    }
}