<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('name_color', 7)->default('#000000');
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('indeed_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('app_store_url')->nullable();
            $table->string('play_store_url')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        });

        // Insert default record
        DB::table('site_settings')->insert([
            'website_name' => config('app.name'),
            'name_color' => '#000000',
            'facebook_url' => null,
            'twitter_url' => null,
            'instagram_url' => null,
            'indeed_url' => null,
            'youtube_url' => null,
            'phone_number' => null,
            'app_store_url' => null,
            'play_store_url' => null,
            'video_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
};