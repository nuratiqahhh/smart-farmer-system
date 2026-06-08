<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    protected $fillable = [

        'name',
        'category',
        'quantity',
        'unit',
        'price',
        'image',
        'grade',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}