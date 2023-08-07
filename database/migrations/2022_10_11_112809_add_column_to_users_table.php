<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('emp_code', 50)->nullable();
            // $table->string('profile_photo_path')->nullable();
            // $table->unsignedBigInteger('employee_id')->nullable();
            // $table->unsignedBigInteger('role_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropColumn('emp_code');
            // $table->dropColumn('employee_id');
            // $table->dropColumn('profile_photo_path');
            // $table->dropColumn('role_id');
        });
    }
};
