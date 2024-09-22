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
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname')->after('password')->nullable();
            $table->string('slug')->after('password')->nullable();
            $table->string('phone')->after('password')->nullable();
            $table->date('birthday')->after('password')->nullable();
            $table->string('adress')->after('password')->nullable();
            $table->string('city')->after('password')->nullable();
            $table->string('social')->after('password')->nullable();
            $table->longText('description')->after('password')->nullable();
            $table->tinyInteger('status')->after('password')->nullable()->default(1);
            $table->foreignId('company_id')->after('password')->constrained()->onUpdate('cascade')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone')->after('password')->nullable();
            $table->dropColumn('birthday')->after('password')->nullable();
            $table->dropColumn('adress')->after('password')->nullable();
            $table->dropColumn('city')->after('password')->nullable();
            $table->dropColumn('social')->after('password')->nullable();
            $table->dropColumn('description')->after('password')->nullable();
            $table->dropColumn('status')->after('password')->nullable()->default(1);
            $table->dropColumn('company_id')->after('password')->constrained()->onUpdate('cascade')->restrictOnDelete();
        });
    }
};
