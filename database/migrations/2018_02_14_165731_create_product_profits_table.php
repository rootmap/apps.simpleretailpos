<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_profits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->dateTime('invoice_datetime');
            $table->integer('customer_id');
            $table->string('customer_name');
            $table->integer('product_total_quantity');
            $table->float('product_total_amount');
            $table->float('product_cost_total_amount');
            $table->float('profit');
            $table->integer('store_id');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('product_profits');
    }
}
