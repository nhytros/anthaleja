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
        Schema::create('korfball_matches', function (Blueprint $table) {
            $table->id();
            $table->string('score_board')->nullable();
            $table->string('winner')->nullable();
            $table->unsignedBigInteger('team_1');
            $table->unsignedBigInteger('team_2');
            $table->string('placement');
            $table->integer('round');
            $table->integer('strikes');
            $table->integer('spares');
            $table->integer('innings');
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
        Schema::dropIfExists('korfball_matches');
    }
};
