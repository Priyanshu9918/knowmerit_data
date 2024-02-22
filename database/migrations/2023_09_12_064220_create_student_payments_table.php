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
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->nullable();
            $table->string('student_id')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('board')->nullable();
            $table->string('amount')->nullable();
            $table->tinyInteger('payment_status')->default('0')->comment('0 => un-paid, 1 => paid')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0 => Inactive, 1 => Active, 2 => Deleted')->nullable();
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
        Schema::dropIfExists('student_payments');
    }
};
