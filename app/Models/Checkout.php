<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        'user_id',
        'fullname',
        'phone',
        'address',
        'payment_method',
        'total_price',
        'status',
    ];
}