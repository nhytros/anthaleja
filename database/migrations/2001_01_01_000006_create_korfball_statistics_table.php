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
        Schema::create('korfball_statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('number_of_players');
            $table->integer('number_of_matches_won');
            $table->integer('goals');
            $table->integer('ranking');
            $table->foreignId('team_id')->constrained('korfball_teams', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('korfball_statistics');
    }
};
