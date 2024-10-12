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
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_id')->nullable(false);
            $table->integer('class_id')->nullable(false);
            $table->integer('subject_id')->nullable(false);
            $table->date('exam_date')->nullable(false);
            $table->time('start_time')->nullable(false);
            $table->time('end_time')->nullable(false);
            $table->string('room_number', 50)->nullable(true)->default(null);
            $table->string('full_marks', 50)->nullable(true)->default(null);
            $table->string('passing_marks', 50)->nullable(true)->default(null);
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_schedules');
    }
};
