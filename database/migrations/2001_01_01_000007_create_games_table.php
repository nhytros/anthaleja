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
        Schema::create('korfball_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_team_id')->constrained('korfball_teams', 'id')->cascadeOnDelete();
            $table->foreignId('away_team_id')->constrained('korfball_teams', 'id')->cascadeOnDelete();
            $table->foreignId('league_id')->constrained('korfball_leagues', 'id')->cascadeOnDelete();
            $table->integer('home_team_points');
            $table->integer('away_team_points');
            $table->string('home_team_name');
            $table->string('away_team_name');
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
        Schema::dropIfExists('korfball_games');
    }
};
