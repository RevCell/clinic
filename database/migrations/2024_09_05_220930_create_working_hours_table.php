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
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id();
            $table->time("StartingTime");
            $table->time("EndingTime");
            $table->boolean("status")->default(false);
            $table->foreignId("doctor_id")->references('id')->on("doctors");
            $table->foreignId("day_id")->references("id")->on("days_of_weeks");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_hours');
    }
};
