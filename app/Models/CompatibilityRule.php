<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompatibilityRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'component_id_1', 'component_id_2',
        'rule_type', 'is_compatible', 'description',
    ];

    protected $casts = [
        'is_compatible' => 'boolean',
    ];

    public function componentOne()
    {
        return $this->belongsTo(Component::class, 'component_id_1');
    }

    public function componentTwo()
    {
        return $this->belongsTo(Component::class, 'component_id_2');
    }
}