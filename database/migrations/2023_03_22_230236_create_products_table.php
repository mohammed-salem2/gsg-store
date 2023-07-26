<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable();
            $table->foreign('category_id')->on('categories')->references('id'); //بشكل ديفلت بكون نوع الحذف ريستركت
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedFloat('price')->default(0);
            $table->unsignedFloat('sale_price')->default(0);
            $table->unsignedSmallInteger('quantity')->default(0);
            $table->enum('status', ['active' , 'draft']);
            $table->unsignedFloat('weight')->nullable();
            $table->unsignedFloat('width')->nullable();
            $table->unsignedFloat('height')->nullable();
            $table->unsignedFloat('length')->nullable();
            $table->string('sku')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
