<?php

use App\Http\Core\Const\Options\PayTypeOptions;
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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stafId')->references('id')->on('stafs')->cascadeOnDelete();
            $table->enum('payType',PayTypeOptions::getAll());
            $table->date('date');
            $table->integer('amount');
            $table->text('description');
            $table->integer('price')->nullable();
            $table->integer('discountAmount')->default(0);
            $table->text('discountBecouse')->nullable();
            $table->string('startDate')->nullable();
            $table->string('endDate')->nullable();
            $table->text('paymrentNote')->nullable();
            $table->boolean('isEnd')->default(false);
            $table->boolean('isCompletePayment')->default(false);
            $table->foreignId('coachId')->nullable()->references('id')->on('coaches')->cascadeOnDelete();
            $table->foreignId('subscriptionId')->nullable()->references('id')->on('subscriptions')->cascadeOnDelete();
            $table->foreignId('userId')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
