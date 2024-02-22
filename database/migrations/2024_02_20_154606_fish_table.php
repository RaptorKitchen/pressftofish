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
        Schema::create('fish', function (Blueprint $table) {
            $table->id('fish_id');
            $table->string('name');
            $table->string('latin_name');
            $table->string('chance_range_start');
            $table->string('chance_range_end');
            $table->string('active_time_of_day_start');
            $table->string('active_time_of_day_end');
            $table->integer('population');
            $table->string('season');
            $table->text('description')->nullable();
            $table->string('image_url');
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
