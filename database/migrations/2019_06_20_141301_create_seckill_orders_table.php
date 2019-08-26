<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeckillOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seckill_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no',30)->unique()->comment('订单编号');
            $table->integer('user_id')->default(0)->comment('用户Id,0 是游客');
            $table->decimal('total_amount',8,2)->comment('总价');
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
        Schema::dropIfExists('seckill_orders');
    }
}
