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
        Schema::dropIfExists('zetten'); // drop if leftover from before
        Schema::create('zetten', function (Blueprint $table) {
            $table->id();
            $table->integer('ronde_id');
            $table->integer('player_x_id');
            $table->integer('player_o_id');
            $table->integer('rij');
            $table->integer('kolom');
            $table->integer('current_turn');
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
