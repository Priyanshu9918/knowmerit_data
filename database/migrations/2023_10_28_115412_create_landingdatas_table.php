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
        Schema::create('landingdatas', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('gender')->nullable();
            $table->longText('subject')->nullable();
            $table->string('subject_type')->nullable();
            $table->tinyInteger('status')->default('1')->comment('0 => Inactive, 1 => Active')->nullable();
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
        Schema::dropIfExists('landingdatas');
    }
};
