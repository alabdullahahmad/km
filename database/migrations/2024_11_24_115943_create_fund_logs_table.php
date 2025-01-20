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
        Schema::create('fund_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stafId')->references('id')->on('stafs')->onDelete('cascade');
            $table->date('date');
            $table->integer('amount');
            $table->boolean('adminRecipient')->default(false);
            $table->boolean('stafRecipient')->default(true);
            $table->foreignId('branchId')->references('id')->on('branches')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_logs');
    }
};
