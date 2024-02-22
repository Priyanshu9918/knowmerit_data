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
        Schema::create('submit_question_students', function (Blueprint $table) {
            $table->id();
            $table->string('u_id',200)->nullable();
            $table->string('student_id',200)->nullable();
            $table->string('question_no',200)->nullable();
            $table->string('ans',200)->nullable();
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
        Schema::dropIfExists('submit_question_students');
    }
};
