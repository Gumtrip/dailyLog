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
            $table->dropColumn('user_id');
        });
    }
}
