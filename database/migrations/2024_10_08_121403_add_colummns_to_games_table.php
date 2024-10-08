<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColummnsToGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('scorer_id')->after('local_team_id');
            $table->integer('timer_id')->after('scorer_id');
            $table->integer('shot_clock_operator_id')->after('timer_id');
            $table->integer('assistant_scorer_id')->after('shot_clock_operator_id');
            $table->boolean('scorer_travels')->after('assistant_scorer_id')->default(false);
            $table->boolean('timer_travels')->after('scorer_travels')->default(false);
            $table->boolean('shot_clock_operator_travels')->after('timer_travels')->default(false);
            $table->boolean('assistant_scorer_travels')->after('shot_clock_operator_travels')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('scorer_id');
            $table->dropColumn('timer_id');
            $table->dropColumn('shot_clock_operator_id');
            $table->dropColumn('assistant_scorer_id');
            $table->dropColumn('scorer_travels');
            $table->dropColumn('timer_travels');
            $table->dropColumn('shot_clock_operator_travels');
            $table->dropColumn('assistant_scorer_travels');
        });
    }
}
