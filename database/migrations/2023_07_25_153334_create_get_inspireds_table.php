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
        Schema::create('get_inspireds', function (Blueprint $table) {
            $table->id();
            $table->string('gi_image');
            $table->string('heading')->nullable();
            $table->string('content')->nullable();
            $table->string('url')->nullable();
            $table->integer('order_by')->nullable();
            $table->integer('status')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('get_inspireds');
    }
};
