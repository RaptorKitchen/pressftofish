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
        Schema::create('fish_stat_association', function (Blueprint $table) {
            $table->id('fish_stat_association_id');
            $table->integer('fish_id');
            $table->string('length');
            $table->integer('weight');
            $table->integer('age');
            $table->integer('range_start');
            $table->integer('range_end');
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
