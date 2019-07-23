<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToGoalCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goal_categories', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->nullable()->after('title');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goal_categories', function (Blueprint $table) {
            $table->dropForeign('goal_categories_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
