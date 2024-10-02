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
        Schema::create('assign_class_teacher', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable(true)->default(null);
            $table->integer('teacher_id')->nullable(true)->default(null);
            $table->tinyInteger('status')
                ->nullable(false)
                ->default(0)
                ->comment('0:active, 1:inactive');
            $table->tinyInteger('is_delete')
                ->nullable(false)
                ->default(0)
                ->comment('0:not delete, 1:delete');
            $table->integer('created_by')->nullable(true)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_class_teacher');
    }
};
