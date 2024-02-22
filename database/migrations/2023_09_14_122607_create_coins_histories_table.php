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
        Schema::create('coins_histories', function (Blueprint $table) {
            $table->id();
            $table->string('tutor_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('title')->nullable();
            $table->string('amount')->nullable();
            $table->tinyInteger('payment_status')->default('0')->comment('0 => un-paid, 1 => paid')->nullable();
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
        Schema::dropIfExists('coins_histories');
    }
};
