<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVarianceDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variance_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variance_id');
            $table->integer('product_id');
            $table->integer('quantity_in_system');
            $table->integer('quantity_in_hand');
            $table->integer('variance_quanity');
            $table->float('cost');
            $table->float('variance_cost');
            $table->integer('store_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
            $table->index('variance_id');
            $table->index('id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variance_datas');
    }
}
