<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'paragraph',
        'image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}