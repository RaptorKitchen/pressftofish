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
        Schema::create('players', function (Blueprint $table) {
            $table->id('player_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('strength');
            $table->integer('dexterity');
            $table->integer('constitution');
            $table->integer('intelligence');
            $table->integer('wisdom');
            $table->integer('charisma');
            $table->integer('conformity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
