<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStafLogingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staf_logings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stafId')->references('id')->on('stafs')->cascadeOnDelete();
            $table->time('enterTime')->nullable();
            $table->time('exitTime')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('staf_logings');
    }
}
