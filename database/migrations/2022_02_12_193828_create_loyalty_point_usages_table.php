<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyPointUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_point_usages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('user_id');

            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->double('used_loyalty_point')->nullable();
            $table->enum('used_for',['purchase','cash']);
            $table->integer('invoice_id')->nullable();
            $table->double('amount')->nullable();

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
        Schema::dropIfExists('loyalty_point_usages');
    }
}
