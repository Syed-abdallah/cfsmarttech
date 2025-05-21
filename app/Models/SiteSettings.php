<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    use HasFactory;
     protected $fillable = [
        'website_name',
        'logo_path',
        'name_color'
    ];
    
    protected $attributes = [
        'website_name' => null,
        'name_color' => '#000000'
    ];
}
