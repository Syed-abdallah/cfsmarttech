<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('name_color', 7)->default('#000000');
            $table->timestamps();
        });

        // Insert default record
        DB::table('site_settings')->insert([
            'website_name' => config('app.name'),
            'name_color' => '#000000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
};