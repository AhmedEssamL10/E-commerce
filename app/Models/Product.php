<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_name',
        'ar_name',
        'image',
        'quantity',
        'status',
        'code',
        'price',
        'en_details',
        'ar_details',
        'brand_id',
        'subcategory_id',
        'category_id',
    ];
    public function order_history()
    {
        # code...
        return $this->hasMany('App\Models\order_history');
    }
}
