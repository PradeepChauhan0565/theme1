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
        Schema::create('heading_single_banners', function (Blueprint $table) {
            $table->id();
            $table->string('heading_rirst')->nullable();
            $table->string('heading_secont')->nullable();
            $table->string('heading_third')->nullable();
            $table->string('heading_forth')->nullable();
            $table->string('banner')->nullable();
            $table->string('url')->nullable();

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
        Schema::dropIfExists('heading_single_banners');
    }
};
