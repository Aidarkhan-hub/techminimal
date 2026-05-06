<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'is_active',
        'user_id',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'price'     => 'float',
            'stock'     => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
