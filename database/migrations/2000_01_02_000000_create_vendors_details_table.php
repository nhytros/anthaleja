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
        Schema::create('market_vbd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('market_vendors', 'id')->cascadeOnDelete();
            $table->string('shop_name');
            $table->string('shop_address')->nullable();
            $table->string('shop_phone')->nullable();
            $table->string('shop_website')->nullable();
            $table->string('shop_email')->nullable();
            $table->string('address_proof')->nullable();
            $table->string('address_proof_image')->nullable();
            $table->string('license_code')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('market_vbank', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('market_vendors', 'id')->cascadeOnDelete();
            $table->string('bank_account', 12);
            $table->decimal('bank_amount', 48, 2)->nullable()->default(0);
            $table->boolean('status')->nullable()->default(1);
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
        Schema::dropIfExists('market_vbank');
        Schema::dropIfExists('market_vbd');
    }
};
