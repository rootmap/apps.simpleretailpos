<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyCardSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_card_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->string('membership_name')->unique();
            $table->string('card_pic_path');

            // is an array  object of different datas like Should display Company name, card name, Customer name, Text color, Membership Since
            $table->text('card_display_config');
            $table->integer('point_range_from');
            $table->integer('point_range_to');
            $table->integer('min_purchase_amount');

            $table->integer('purchase_amount_to_point_conversion_rate');

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
        Schema::dropIfExists('loyalty_card_settings');
    }
}
