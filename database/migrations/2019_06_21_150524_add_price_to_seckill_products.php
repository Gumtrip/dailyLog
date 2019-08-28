<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceToSeckillProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seckill_products', function (Blueprint $table) {
            $table->decimal('price',8,2)->after('stock')->default(0)->comment('价格');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seckill_products', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
