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
        Schema::table('mark_registers', function (Blueprint $table) {
            $table->integer('full_marks')
                ->nullable(false)
                ->default(0)
                ->after('exam_work');
            $table->integer('passing_marks')
                ->nullable(false)
                ->default(0)
                ->after('full_marks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('full_marks');
            $table->dropColumn('passing_marks');
        });
    }
};
