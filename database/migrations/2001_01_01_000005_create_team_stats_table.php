<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korfball_team_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('total')->nullable();
            $table->integer('long')->nullable();
            $table->integer('medium')->nullable();
            $table->integer('near')->nullable();
            $table->integer('running_in_shot')->nullable();
            $table->integer('free_pass')->nullable();
            $table->integer('penalty_shot')->nullable();
            $table->integer('penalty_shot_missed')->nullable();
            $table->integer('score_ratio_m')->nullable();
            $table->integer('score_ratio_f')->nullable();
            $table->integer('yellow_cards')->nullable();
            $table->integer('red_cards')->nullable();
            $table->integer('substitutions')->nullable();
            $table->integer('time_outs')->nullable();
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
        Schema::dropIfExists('korfball_team_stats');
    }
};
