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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tagId')->references('id')->on('tags')->cascadeOnDelete();
            $table->foreignId('categoryId')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('name');
            $table->integer('price');
            $table->integer('numOfDays');
            $table->integer('numOfSessions');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
