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
        Schema::create('bill_logs', function (Blueprint $table) {
            $table->id();
            $table->boolean('subscriptionDateModified')->default(false);
            $table->foreignId('stafId')->references('id')->on('stafs')->cascadeOnDelete();
            $table->date('startDateAfterEdit')->nullable();
            $table->boolean('isTypeModified')->default(false);
            $table->foreignId('subscriptionBeforeEdit')->nullable()->references('id')->on('subscriptions')->cascadeOnDelete();
            $table->foreignId('subscriptionAfterEdit')->nullable()->references('id')->on('subscriptions')->cascadeOnDelete();
            $table->foreignId('billId')->references('id')->on('bills')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_logs');
    }
};
