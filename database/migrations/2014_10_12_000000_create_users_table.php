<?php

use App\Http\Core\Const\Options\GendorOptions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthDay');
            $table->enum('gender',GendorOptions::$gendor);
            $table->string('phoneNumber')->unique();
            // $table->string('familyNumber')->nullable();
            // $table->string('homeNumber')->nullable();
            // $table->string('address')->nullable();
            // $table->string('personalid')->nullable();
            $table->text('qr')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(Hash::make("12345678"));
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
