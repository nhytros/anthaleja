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
        Schema::create('market_product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('market_products', 'id')->cascadeOnDelete();
            $table->string('sku');
            $table->string('size');
            $table->decimal('price', 12, 2);
            $table->integer('stock');
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_product_attributes');
    }
};
