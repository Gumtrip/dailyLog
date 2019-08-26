<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeckillProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seckill_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150)->comment('名称');
            $table->integer('stock')->default(0)->comment('库存');
            $table->timestamp('start_date')->nullable()->comment('开始时间');
            $table->timestamp('end_date')->nullable()->comment('结束时间');
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
        Schema::dropIfExists('seckill_products');
    }
}
