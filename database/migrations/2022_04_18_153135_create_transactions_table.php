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
            $table->integer("user_id");
            $table->integer("jacket_id");
            $table->integer("size_id");
            $table->boolean("order_type")->default("0");
            $table->string("custom")->nullable();
            $table->integer("price");
            $table->string("proof")->nullable();
            $table->boolean("is_paid")->default("0");
            $table->boolean("is_done")->default("0");
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
