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
            $table->string("user_id");
            $table->integer("jacket_id");
            $table->integer("size_id");
            $table->string("custom")->nullable();
            $table->integer("price");
            $table->string("bank")->nullable();
            $table->string("proof")->nullable();
            $table->integer("status")->default("1");
            $table->boolean("is_paid")->default("0");
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