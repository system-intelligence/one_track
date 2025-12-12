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
            $table->string('printer')->nullable()->after('gpu');
            $table->string('mouse')->nullable()->after('printer');
            $table->string('keyboard')->nullable()->after('mouse');
            $table->dropColumn('peripherals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['printer', 'mouse', 'keyboard']);
            $table->string('peripherals')->nullable()->after('gpu');
        });
    }
};
