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
        Schema::create('count_dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('cetified_courses_count')->nullable();
            $table->string('expert_tutors_count')->nullable();
            $table->string('online_students_count')->nullable();
            $table->string('online_courses_count')->nullable();
            $table->string('cetified_courses')->nullable();
            $table->string('expert_tutors')->nullable();
            $table->string('online_students')->nullable();
            $table->string('online_courses')->nullable();
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
        Schema::dropIfExists('count_dashboards');
    }
};
