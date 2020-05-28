<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceLayoutTwosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_layout_twos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->default('Robust Creative Studio');
            $table->string('address')->default('4025 Oak Avenue,');
            $table->string('city')->default('Melbourne,');
            $table->string('state')->default('Florida 32940,');
            $table->string('country')->default('USA');
            $table->string('logo')->default('nd_logo.png');
            $table->string('signature')->default('nd_logo_sig.png');
            $table->string('auth_name')->default('Amanda Orton');
            $table->string('auth_designation')->default('Managing Director');
            $table->string('terms')->default('You know, being a test pilot is not always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.');

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
        Schema::dropIfExists('invoice_layout_twos');
    }
}
