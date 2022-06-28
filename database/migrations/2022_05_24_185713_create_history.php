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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->enum('productivity', ['1', '2', '3'])->nullable();
            $table->foreignId('user_id')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('proyect_id')->references('id')->on('proyect')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('homework_id')->references('id')->on('homework')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('history');
    }
};
