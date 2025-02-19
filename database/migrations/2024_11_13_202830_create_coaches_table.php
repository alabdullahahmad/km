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
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('password');
            $table->string('phoneNumber')->unique();
            $table->string('address')->nullable();
            // $table->string('personalid');
            $table->enum('gender',GendorOptions::$gendor);
            $table->date("birthDay");
            $table->integer("percentage");
            $table->json("class")->nullable();
            $table->foreignId('branchId')->references('id')->on('branches')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
