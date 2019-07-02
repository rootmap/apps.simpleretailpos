<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrinterPrintSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_print_sizes', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('pos_width')->default('595');
            $table->integer('pos_height')->default('842');

            $table->integer('thermal_width')->default('58');
            $table->integer('thermal_height')->default('240');

            $table->integer('barcode_width')->default('58');
            $table->integer('barcode_height')->default('240');

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
        Schema::dropIfExists('printer_print_sizes');
    }
}
