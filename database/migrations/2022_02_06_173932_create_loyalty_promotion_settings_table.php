<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyPromotionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_promotion_settings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('created_by');

            $table->string('promotion_title');
            $table->string('for_membership_type')->nullable();
            $table->double('currency_to_loyalty_conversion_rate');
            $table->string('start_at');
            $table->string('end_at');
            $table->enum('status',['active','inactive','draft']);

            $table->softDeletes();
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
        Schema::dropIfExists('loyalty_promotion_settings');
    }
}
