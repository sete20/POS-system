<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->string('image')->default('default.png');
            $table->double('purchase_price',8,2);  
            $table->double('sale_price',8,2);
            $table->integr('stock');     
            $table->integr('catogry_id');
            $table->timestamps();
            $table->foreign('catogry_id')->referenes('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
