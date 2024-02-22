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
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->string('mcq_type_id',200)->nullable();
            $table->string('Questions',200)->nullable();
            $table->string('ans1',200)->nullable();
            $table->string('ans2',200)->nullable();
            $table->string('ans3',200)->nullable();
            $table->string('ans4',200)->nullable();
            $table->string('answer',200)->nullable();
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
        Schema::dropIfExists('mcqs');
    }
};
