<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyStoreSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_store_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');

            $table->boolean('is_in_loyalty_program');
            $table->boolean('allow_cash_withdrawal_by_loyanty_point');
            $table->integer('currency_to_loyalty_conversion_rate');
            $table->string('min_purchase_amount ');

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
        Schema::dropIfExists('loyalty_store_settings');
    }
}
