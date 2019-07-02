<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_profits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');
            $table->dateTime('invoice_datetime');
            $table->integer('customer_id');
            $table->string('customer_name');
            $table->float('invoice_total_amount');
            $table->float('invoice_cost_total_amount');
            $table->float('profit');
            $table->integer('store_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
            $table->index('invoice_id');
            $table->index('id');
            $table->index('invoice_datetime');
            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_profits');
    }
}
