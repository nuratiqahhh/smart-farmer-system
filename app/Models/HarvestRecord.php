<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HarvestRecord extends Model
{
    protected $fillable = [

        'user_id',
        'product_id',
        'harvest_quantity',
        'harvest_date',
        'notes'

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}