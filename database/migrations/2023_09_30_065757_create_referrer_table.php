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
        Schema::create('referrer', function (Blueprint $table) {
            $table->id();
            $table->string('referrer_id')->nullable();
            $table->string('referral_id')->nullable();
            $table->string('referrer_amount')->nullable();
            $table->string('referral_amount')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0 => Inactive, 1 => Active, 2 => Deleted')->nullable();
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
        Schema::dropIfExists('referrer');
    }
};
