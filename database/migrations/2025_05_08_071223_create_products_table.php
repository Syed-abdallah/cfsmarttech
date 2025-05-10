<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('description');
            $table->string('sku')->unique(); // unique product identifier
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->longText('text')->nullable();
            $table->decimal('price', 10, 2); // price with 2 decimal places (e.g., 99999999.99)
            $table->integer('quantity')->default(0); // default stock quantity
            $table->string('product_active')->default('1');
            $table->string('is_sell')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
