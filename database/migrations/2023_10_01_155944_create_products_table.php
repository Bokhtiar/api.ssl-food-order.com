<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /* Run the migrations. */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('slug');
            $table->string('title');
            $table->string('image');
            $table->integer('category_id');
            $table->integer('price')->nullable();
            $table->longText('body')->nullable();
            $table->integer('total_qty')->nullable();
            $table->integer('available_qty')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /* Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
