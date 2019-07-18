<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeklyPlansTable extends Migration
{
    /**
     * Run the migrations.
     * z
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->comment('名称');
            $table->integer('mission_amount')->comment('任务总数');
            $table->integer('mission_accomplish_amount')->comment('完成任务总数');
            $table->integer('bonus')->default(0)->comment('奖金');
            $table->tinyInteger('is_done')->default(0)->comment('是否完成');
            $table->softDeletes();
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
        Schema::dropIfExists('weekly_plans');
    }
}
