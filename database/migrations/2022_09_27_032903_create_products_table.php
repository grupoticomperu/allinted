<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique();
            $table->string('codigobarrasi')->unique();
            $table->string('codigobarrase')->unique();
            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->double('purchaseprice', 8, 4)->nullable();//precio-compra
            $table->double('saleprice', 8, 4)->nullable();//precio venta
            $table->double('salepricemin', 8, 4)->nullable();//precio venta minimo

            $table->double('stock', 8, 2)->nullable();
            $table->double('stockmin', 8, 2)->nullable();

            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');

            $table->unsignedBigInteger('um_id')->nullable();
            $table->foreign('um_id')->references('id')->on('ums')->onDelete('cascade');

            $table->unsignedBigInteger('modelo_id')->nullable();
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');


            $table->boolean('state')->default(false);

            $table->string('image')->nullable();
            $table->string('typeproduct')->nullable();

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
        Schema::dropIfExists('products');
    }
};
