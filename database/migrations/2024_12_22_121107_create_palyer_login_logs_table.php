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
        Schema::create('palyer_login_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('userId')->references('id')->on('users')->cascadeOnDelete();
            $table->string('subscriptionName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palyer_login_logs');
    }
};
