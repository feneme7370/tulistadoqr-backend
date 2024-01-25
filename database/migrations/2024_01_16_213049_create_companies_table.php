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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('adress')->nullable();
            $table->string('city')->nullable();
            $table->string('social')->nullable();
            $table->string('url')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->string('image_qr')->nullable();
            $table->string('image_logo')->nullable();
            $table->string('image_hero')->nullable();
            $table->foreignId('membership_id')->constrained()->onUpdate('cascade')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
