<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeckillOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('seckill_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seckill_order_id')->unsigned();
            $table->foreign('seckill_order_id')->references('id')->on('seckill_orders')->onDelete('cascade');
            $table->bigInteger('seckill_product_id');
            $table->decimal('price',8,2);
            $table->integer('amount');
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
        Schema::dropIfExists('seckill_order_items');
    }
}
