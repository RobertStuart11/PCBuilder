<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'brand', 'category',
        'description', 'price', 'stock', 'image', 'is_active',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relasi
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function compatibilityAsFirst()
    {
        return $this->hasMany(CompatibilityRule::class, 'component_id_1');
    }

    public function compatibilityAsSecond()
    {
        return $this->hasMany(CompatibilityRule::class, 'component_id_2');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Helper: format harga Rupiah
    public function getPriceFormattedAttribute(): string
    {
        return 'Rp ' . number_format((float)$this->price, 0, ',', '.');
    }

    // Helper: get image URL
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/no-image.png');
        }
        
        // Jika path sudah dimulai dengan "images/" (produk lama), gunakan asset() langsung
        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }
        
        // Jika path dari storage (produk baru), tambahkan prefix "storage/"
        return asset('storage/' . $this->image);
    }
}