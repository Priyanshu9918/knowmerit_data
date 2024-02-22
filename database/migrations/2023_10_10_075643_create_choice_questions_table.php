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
        Schema::create('choice_questions', function (Blueprint $table) {
            $table->id();
            $table->string('u_id',200)->nullable();
            $table->string('welcome_id',200)->nullable();
            $table->string('teacher_id',200)->nullable();
            $table->longText('question',200)->nullable();
            $table->longText('option',200)->nullable();
            $table->string('answer',200)->nullable();
            $table->string('type',200)->nullable();
            $table->string('page',200)->nullable();
            $table->string('point',200)->nullable();
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
        Schema::dropIfExists('choice_questions');
    }
};
