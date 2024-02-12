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
            $table->string('slug');
            $table->double('price_original');
            $table->double('price_seller')->nullable();
            $table->integer('quantity')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('image_hero_uri')->nullable();
            $table->string('image_hero')->nullable();
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->restrictOnDelete();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->restrictOnDelete();
            $table->foreignId('company_id')->constrained()->onUpdate('cascade')->restrictOnDelete();
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
