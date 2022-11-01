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
        Schema::create('market_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->string('color')->nullable();
            $table->boolean('is_promo')->nullable()->default(0);
            $table->datetime('start_promo')->nullable();
            $table->datetime('end_promo')->nullable();
            $table->decimal('price', 12, 2)->nullable()->default(0);
            $table->decimal('discount', 12, 2)->nullable()->default(0);
            $table->decimal('weight', 12, 2)->nullable()->default(0);
            $table->string('main_image')->nullable();
            $table->string('video')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_featured')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(0);
            $table->boolean('is_bestseller')->nullable()->default(0);
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
        Schema::dropIfExists('market_products');
    }
};
