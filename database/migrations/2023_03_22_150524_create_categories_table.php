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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')->on('categories')->references('id')->nullOnDelete(); //عشان استخدم خاصية نل ديليت يجب استخدام معها انو العمود بقبل القيمة الفارغة
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status' , ['active' , 'draft']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
