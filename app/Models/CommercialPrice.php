<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialPrice extends Model
{
    use HasFactory;
       protected $fillable = [
       
        'price',
      'size'
    ];
}
