<?php

namespace App\Models;

use App\Casts\Price;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => OrderStatus::class,
        'total_price' => Price::class
    ];

    protected $fillable = [
        'status',
        'total_price'
    ];
}
