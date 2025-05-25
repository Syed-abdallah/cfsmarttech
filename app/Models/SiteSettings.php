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
        'name_color',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'indeed_url',
        'youtube_url',
        'phone_number',
        'app_store_url',
        'play_store_url',
        'video_url'
    ];
    
    protected $attributes = [
        'website_name' => null,
        'name_color' => '#000000',
        'facebook_url' => null,
        'twitter_url' => null,
        'instagram_url' => null,
        'indeed_url' => null,
        'youtube_url' => null,
        'phone_number' => null,
        'app_store_url' => null,
        'play_store_url' => null
    ];
}