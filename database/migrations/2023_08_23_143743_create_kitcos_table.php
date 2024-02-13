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
        Schema::create('kitcos', function (Blueprint $table) {
            $table->id();
            $table->string('metal_type');
            $table->integer('gram')->nullable();
            $table->decimal('rate')->nullable();
            $table->decimal('kt10', 10, 2)->nullable();
            $table->decimal('kt14', 10, 2)->nullable();
            $table->decimal('kt18', 10, 2)->nullable();
            $table->decimal('kt22', 10, 2)->nullable();


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
        Schema::dropIfExists('kitcos');
    }
};
