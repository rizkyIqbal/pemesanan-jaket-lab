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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer("jacket_id");
            $table->unsignedBigInteger("size_id");
            $table->foreign("size_id")->references("id")->on("sizes");
            $table->string("custom")->nullable();
            $table->string("user_id");
            $table->string("phone_number");
            $table->integer("price");
            $table->integer("bank_id")->nullable();
            $table->string("transfer_from")->nullable();
            $table->string("proof")->nullable();
            $table->unsignedBigInteger("track_id")->default("1");
            $table->foreign("track_id")->references("id")->on("tracks");
            $table->integer("status")->default("1");
            $table->integer("order_type");
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
        Schema::dropIfExists('transactions');
    }
};
