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
        Schema::create('mark_registers', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable(false);
            $table->integer('exam_id')->nullable(false);
            $table->integer('class_id')->nullable(false);
            $table->integer('subject_id')->nullable(false);
            $table->integer('class_work')->nullable(true)->default(null);
            $table->integer('home_work')->nullable(true)->default(null);
            $table->integer('test_work')->nullable(true)->default(null);
            $table->integer('exam_work')->nullable(true)->default(null);
            $table->integer('created_by')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mark_registers');
    }
};
