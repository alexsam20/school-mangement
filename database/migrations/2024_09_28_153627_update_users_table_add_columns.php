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
        Schema::table('users', function (Blueprint $table) {
            $table->string('marital_status',55)->after('occupation')->nullable(true)->default(null);
            $table->string('permanent_address',255)->after('address')->nullable(true)->default(null);
            $table->string('qualification',255)->after('marital_status')->nullable(true)->default(null);
            $table->string('work_experience',255)->after('qualification')->nullable(true)->default(null);
            $table->string('note',255)->after('work_experience')->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('marital_status');
            $table->dropColumn('permanent_address');
            $table->dropColumn('qualification');
            $table->dropColumn('work_experience');
            $table->dropColumn('note');
        });
    }
};
