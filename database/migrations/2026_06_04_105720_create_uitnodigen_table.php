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
        Schema::create('uitnodigen', function (Blueprint $table) {
            $table->id();
            $table->integer('spel_id');
            $table->integer('van_speler_id');
            $table->integer('naar_speler_id');
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uitnodigen');
    }
};
