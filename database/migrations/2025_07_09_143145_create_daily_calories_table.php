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
        Schema::create('daily_calories', function (Blueprint $table) {
            $table->id();
            // $table->date('date');
            $table->float('calories_in');
            $table->float('calories_out');
            $table->float('recommended_calories');
            // $table->float('calorie_deficit');
            $table->foreignId('user_id')->constrained(
                table: 'users',
                column: 'id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_calories');
    }
};
