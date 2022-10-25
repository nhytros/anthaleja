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
        Schema::create('korfball_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('korfball_teams', 'id')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->nullable();
            $table->string('gender', 12);
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('korfball_players');
    }
};
