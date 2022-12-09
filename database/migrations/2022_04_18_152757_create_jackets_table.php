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
        Schema::create('jackets', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("price");
            $table->integer("custom_price");
            $table->string("image");
            $table->string("image2");
            $table->string("image_size_chart");
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
        Schema::dropIfExists('jackets');
    }
};
