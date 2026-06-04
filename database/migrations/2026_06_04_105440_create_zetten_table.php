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
        Schema::create('zetten', function (Blueprint $table) {
            $table->id();
            $table->integer('ronde_id');
            $table->integer('speler_id');
            $table->integer('rij');
            $table->integer('kolom');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zetten');
    }
};
