<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->dateTime('exchange_at');
            $table->integer('status')->nullable(false);
            $table->integer('approved')->default(0);
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('merchandise_id');
            $table->timestamps();
            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->foreign('merchandise_id')->references('id')->on('merchandises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
