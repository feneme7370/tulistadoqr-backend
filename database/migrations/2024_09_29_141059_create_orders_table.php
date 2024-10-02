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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();

            $table->date('date')->nullable();
            $table->string('client')->nullable();
            $table->string('adress')->nullable();
            $table->string('type_send')->nullable();
            $table->longText('description')->nullable();

            $table->tinyInteger('status')->nullable();

            $table->tinyInteger('is_maked')->nullable();
            $table->tinyInteger('is_paid')->nullable();
            $table->tinyInteger('is_delivered')->nullable();

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
        Schema::dropIfExists('orders');
    }
};
