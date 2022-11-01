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
        Schema::create('market_product_filters', function (Blueprint $table) {
            $table->id();
            $table->longText('cat_ids')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->softDeletes();
        });

        Schema::create('market_product_filter_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filter_id')->constrained('market_product_filters', 'id');
            $table->string('value');
            $table->boolean('status')->nullable()->default(1);
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
        Schema::dropIfExists('market_product_filter_values');
        Schema::dropIfExists('market_product_filters');
    }
};
