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
        Schema::create('class_subject_timetables', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->integer('week_id');
            $table->time('start_time')->nullable(true)->default(null);
            $table->time('end_time')->nullable(true)->default(null);
            $table->string('room_number', 50)->nullable(true)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_subject_timetables');
    }
};
