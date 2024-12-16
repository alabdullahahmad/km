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
        Schema::create('subscription_coaches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscriptionId')->references('id')->on('subscriptions')->cascadeOnDelete();
            $table->foreignId('coachId')->references('id')->on('coaches')->cascadeOnDelete();
            $table->foreignId('roomId')->references('id')->on('rooms')->cascadeOnDelete();
            $table->string('fromHouer');
            $table->string('toHouer');
            $table->string('period');
            $table->integer('dayOfWeek')->min(1)->max(7)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_coaches');
    }
};
