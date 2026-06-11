<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_code', 'status', 'total_price',
        'shipping_address', 'payment_method', 'payment_status', 'midtrans_token',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    // Auto-generate order code sebelum insert
    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->order_code = 'PCB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        });
    }

    // Relasi
    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Helper
    public function getTotalFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'bg-yellow-100 text-yellow-700',
            'paid'       => 'bg-green-100 text-green-700',
            'processing' => 'bg-blue-100 text-blue-700',
            'shipped'    => 'bg-purple-100 text-purple-700',
            'delivered'  => 'bg-green-100 text-green-700',
            'cancelled'  => 'bg-red-100 text-red-700',
            default      => 'bg-gray-100 text-gray-700',
        };
    }
}