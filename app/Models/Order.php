<?php

namespace App\Models;

use App\Support\Values\Number;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'amount',
        'discount_amount',
        'user_amount',
    ];

    protected $casts = [
        'amount' => Number::class,
        'discount_amount' => Number::class,
        'user_amount' => Number::class,
    ];
}
