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
        Schema::create('korfball_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('league_id')->constrained('korfball_leagues', 'id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('country')->nullable();
            $table->string('flag')->nullable();
            $table->string('logo')->nullable();
            $table->integer('total_points')->nullable()->default(0);
            $table->integer('total_goals_scored')->nullable()->default(0);
            $table->integer('total_goals_conceded')->nullable()->default(0);
            $table->integer('total_game_played')->nullable()->default(0);
            $table->integer('total_wins')->nullable()->default(0);
            $table->integer('total_loses')->nullable()->default(0);
            $table->integer('total_draws')->nullable()->default(0);
            $table->decimal('strike_ratio', 12, 2)->nullable()->default(0);
            $table->decimal('spare_ratio', 12, 2)->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('korfball_teams');
    }
};
