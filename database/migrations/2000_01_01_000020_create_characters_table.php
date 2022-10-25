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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('first_name', 48);
            $table->string('last_name', 48);
            $table->string('username', 96)->unique();
            $table->string('gender', 6);
            $table->unsignedTinyInteger('height')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('bank_account', 12);
            $table->decimal('bank_amount', 48, 2)->nullable()->default(500);
            $table->decimal('cash', 48, 2)->nullable()->default(0);
            $table->decimal('metals', 12, 2)->nullable()->default(0);
            $table->boolean('has_phone')->nullable();
            $table->string('phone_no', 8)->nullable();
            $table->string('avatar')->nullable();
            $table->unsignedTinyInteger('thirst')->nullable()->default(0);
            $table->unsignedTinyInteger('hunger')->nullable()->default(0);
            $table->unsignedTinyInteger('energy')->nullable()->default(100);
            // Status: 0: Disabled, 1: Enabled, 2: Archived
            $table->tinyInteger('status')->nullable()->default(1);
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
        Schema::dropIfExists('characters');
    }
};
