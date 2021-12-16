<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'got_it',
        'price_total',
        'use_coupon',
        'price_total_coupon',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'got_it' => 'boolean',
        'price_total' => 'float',
        'use_coupon' => 'boolean',
        'price_total_coupon' => 'float',
    ];
}
