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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('office');     // Office or location
            $table->string('user')->nullable(); //
            $table->string('type');       // Laptop / Desktop / Monitor etc.
            $table->string('os')->nullable();
            $table->string('processor')->nullable();
            $table->string('ram')->nullable();
            $table->string('gpu')->nullable();
            $table->string('condition')->default('Good');
            $table->date('last_maintenance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
