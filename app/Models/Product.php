<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'price',
        'quantity',
        'description',
        'sku',
        'image1',
        'image2',
        'text',
        'product_active',
        'is_sell'
    ];
}
