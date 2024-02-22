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
        Schema::create('book_a_classes', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->string('pincode')->nullable();
            $table->string('first_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('classes_choice')->nullable();
            $table->string('payment_status')->nullable();
            $table->tinyInteger('status')->default('1')->comment('0 => Inactive, 1 => Active')->nullable();
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
        Schema::dropIfExists('book_a_classes');
    }
};
