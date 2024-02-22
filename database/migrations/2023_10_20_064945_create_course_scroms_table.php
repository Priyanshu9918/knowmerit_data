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
        Schema::create('course_scroms', function (Blueprint $table) {
            $table->id();
            $table->string('lession_id',200)->nullable();
            $table->string('title')->nullable();
            $table->string('file')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('is_completed')->nullable();
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
        Schema::dropIfExists('course_scroms');
    }
};
