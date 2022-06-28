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
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->foreignId('user_id')->references('id')->on('user')->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId('proyect_id')->references('id')->on('proyect')->onDelete('cascade');
            $table->integer('time_improduct');
            $table->integer('time_normal');
            $table->integer('time_product');
            $table->integer('count');
            $table->integer('total_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homework');
    }
};
