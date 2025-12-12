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
        Schema::table('assets', function (Blueprint $table) {
            $table->string('surge_protector')->nullable()->after('gpu');
            $table->dropColumn(['ups', 'avr']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn('surge_protector');
            $table->string('ups')->nullable()->after('gpu');
            $table->string('avr')->nullable()->after('ups');
        });
    }
};
