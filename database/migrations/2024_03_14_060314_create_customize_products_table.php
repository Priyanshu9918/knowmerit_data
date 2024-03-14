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
        Schema::create('customize_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id',200)->nullable();
            $table->string('customize_title',200)->nullable();
            $table->string('customize_price',200)->nullable();
            $table->string('customize_pack',200)->nullable();
            $table->string('customize_image',200)->nullable();
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
        Schema::dropIfExists('customize_products');
    }
};
