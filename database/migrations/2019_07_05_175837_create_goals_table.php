<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',100)->comment('名称');
            $table->string('remark',191)->nullable()->comment('备注');
            $table->unsignedInteger('bonus')->default(0)->comment('奖金');
            $table->integer('mission_amount')->comment('任务总数');
            $table->integer('mission_accomplish_amount')->default(0)->comment('完成任务总数');
            $table->timestamp('done_at')->nullable()->comment('完成时间');
            $table->timestamp('gain_at')->nullable()->comment('获取奖品时间');
            $table->timestamp('fail_at')->nullable()->comment('失败时间，一般是个人主观因素导致失败');
            $table->timestamp('cancel_at')->nullable()->comment('取消时间，一般是外部原因导致无法再挑战');
            $table->timestamp('start_at')->nullable()->comment('开始时间');
            $table->timestamp('end_at')->nullable()->comment('结束时间');
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
        Schema::dropIfExists('goals');
    }
}
