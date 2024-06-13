<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('city_id');#FK, tp ngga ditulis langsung, pake sql nanti ngolahnya
            // $table->foreignId('city_id')->references('city_id')->on('cities')->onDelete('cascade');
            $table->string('address');
            $table->string('account_activated');
            $table->string('image_path');
            $table->string('bank_id');
            $table->string('account_number');
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
};
