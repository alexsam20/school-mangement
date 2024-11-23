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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->default(null);
            $table->date('attendance_date')->default(null);
            $table->integer('student_id')->default(null);
            $table->tinyInteger('attendance_type')->default(null)->comment('1:Present, 2:Late, 3:Absent, 4:Half Day');
            $table->integer('created_by')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
