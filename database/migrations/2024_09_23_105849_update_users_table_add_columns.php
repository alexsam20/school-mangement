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
            $table->string('last_name', 255)->after('name')->nullable(true)->default(null);
            $table->string('admission_name', 50)->after('remember_token')->nullable(true)->default(null);
            $table->string('roll_number', 50)->after('admission_name')->nullable(true)->default(null);
            $table->integer('class_id')->after('roll_number')->nullable(true)->default(null);
            $table->string('gender', 50)->after('class_id')->nullable(true)->default(null);
            $table->date('date_of_birth')->after('gender')->nullable(true)->default(null);
            $table->string('caste', 50)->after('date_of_birth')->nullable(true)->default(null);
            $table->string('religion', 50)->after('caste')->nullable(true)->default(null);
            $table->string('mobile_number', 15)->after('religion')->nullable(true)->default(null);
            $table->date('admission_date')->after('mobile_number')->nullable(true)->default(null);
            $table->string('profile_pic', 100)->after('admission_date')->nullable(true)->default(null);
            $table->string('blood_group', 10)->after('profile_pic')->nullable(true)->default(null);
            $table->string('height', 10)->after('blood_group')->nullable(true)->default(null);
            $table->string('weight', 10)->after('height')->nullable(true)->default(null);
            $table->tinyInteger('status')->after('is_delete')->nullable(true)->default(0)->comment('0:active, 1:inactive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('admission_name');
            $table->dropColumn('roll_number');
            $table->dropColumn('class_id');
            $table->dropColumn('gender');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('caste');
            $table->dropColumn('religion');
            $table->dropColumn('mobile_number');
            $table->dropColumn('admission_date');
            $table->dropColumn('profile_pic');
            $table->dropColumn('blood_group');
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('status');
        });
    }
};
