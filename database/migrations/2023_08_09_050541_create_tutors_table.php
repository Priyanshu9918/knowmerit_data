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
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('name',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('c_code',200)->nullable();
            $table->string('mobile')->nullable();
            $table->string('gender',200)->nullable();
            $table->string('parent_id',200)->nullable();
            $table->string('location',200)->nullable();
            $table->string('lng',200)->nullable();
            $table->string('lat',200)->nullable();
            $table->string('image',1000)->nullable();
            $table->tinyInteger('status')->default('0')->comment('0 => Inactive, 1 => Active, 2 => Deleted')->nullable();
            $table->string('language',200)->nullable();
            $table->string('backgorund_experience',200)->nullable();
            $table->string('degree',200)->nullable();
            $table->string('institute_name')->nullable();
            $table->string('degree_status',200)->nullable();
            $table->string('school_board',200)->nullable();
            $table->string('conduct_mode_class',200)->nullable();
            $table->string('tutor_travel',200)->nullable();
            $table->string('teaching_experience')->nullable();
            $table->string('experience_year',200)->nullable();
            $table->string('classes_mode',200)->nullable();
            $table->string('charge_amount',200)->nullable();
            $table->string('all_state_subject',200)->nullable();
            $table->string('describe_experience',200)->nullable();
            $table->string('payment_status',200)->nullable();
            $table->tinyInteger('is_featured')->default('0')->comment('0 => Inactive, 1 => Active, 2 => Deleted')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutors');
    }
};
