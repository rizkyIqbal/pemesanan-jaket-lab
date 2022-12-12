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
            $table->integer("size_id");
            $table->string("custom")->nullable();
            $table->string("user_id");
            $table->string("phone_number");
            $table->integer("price");
            $table->integer("bank_id")->nullable();
            $table->string("transfer_from")->nullable();
            $table->string("proof")->nullable();
            $table->integer("track")->default("1");
            $table->integer("status")->default("1");
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
