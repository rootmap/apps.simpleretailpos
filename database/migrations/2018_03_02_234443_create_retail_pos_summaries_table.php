<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetailPosSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retail_pos_summaries', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('sales_invoice_quantity');
            $table->integer('sales_quantity');
            $table->float('sales_amount');
            $table->float('sales_cost');
            $table->float('sales_profit');

            $table->integer('product_item_quantity');
            $table->integer('product_quantity');
            $table->integer('stockin_invoice_quantity');
            $table->integer('stockin_product_quantity');
            $table->integer('customer_quantity');
            $table->integer('variance_quantity');
            $table->integer('warranty_invoice_quantity');
            $table->integer('warranty_product_quantity');


            $table->integer('store_id');
            $table->integer('created_by');
            $table->integer('updated_by');            
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
        Schema::dropIfExists('retail_pos_summaries');
    }
}
