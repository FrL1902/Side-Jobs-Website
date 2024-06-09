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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('job_description');
            $table->integer('job_compensation');
            $table->dateTime('job_deadline');
            $table->string('job_status');
            $table->string('is_active');
            $table->string('is_online');
            $table->string('address');
            $table->string('city');
            $table->string('worker_id');
            $table->string('employer_id');
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
        Schema::dropIfExists('jobs');
    }
};
