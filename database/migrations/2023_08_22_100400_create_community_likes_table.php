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
        Schema::create('community_likes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id',200)->nullable();
            $table->string('community_id',200)->nullable();
            $table->tinyInteger('status')->default('0')->comment('0 => dislike, 1 => like')->nullable();
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
        Schema::dropIfExists('community_likes');
    }
};
