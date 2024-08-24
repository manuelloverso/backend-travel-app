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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->string('image', 200)->nullable();
            $table->string('destination', 50)->nullable();
            $table->date('departure_date')->nullable();
            $table->tinyInteger('trip_duration', false, true)->nullable();
            $table->tinyInteger('number_of_people', false, true)->nullable();
            $table->integer('available_budget', false, true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
