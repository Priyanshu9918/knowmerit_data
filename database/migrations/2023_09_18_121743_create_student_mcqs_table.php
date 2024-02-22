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
        Schema::create('student_mcqs', function (Blueprint $table) {
            $table->id();
            $table->string('student_id',200)->nullable();
            $table->string('category',200)->nullable();
            $table->string('sub_category',200)->nullable();
            $table->string('mcq_id',200)->nullable();
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
        Schema::dropIfExists('student_mcqs');
    }
};
