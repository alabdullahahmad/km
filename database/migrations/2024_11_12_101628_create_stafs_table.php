<?php

use App\Http\Core\Const\Options\GendorOptions;
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
        Schema::create('stafs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phoneNumber')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->boolean('isAdmin')->default(false);
            $table->string('personalid')->nullable();
            $table->enum('gender',GendorOptions::$gendor);
            $table->date('birthDay');
            $table->boolean('status')->default(true);
            $table->string('user_type')->default('staf');
            $table->foreignId('branchId')->references('id')->on('branches')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stafs');
    }
};
