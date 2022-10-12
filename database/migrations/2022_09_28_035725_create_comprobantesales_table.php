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
        Schema::create('comprobantesales', function (Blueprint $table) {
            $table->id();

            $table->string('serie');
            $table->integer('numero');
            $table->timestamp('fechaemision')->nullable();
            $table->timestamp('fechavencimiento')->nullable();
            $table->double('total', 8, 2)->nullable();//precio venta
            $table->string('formadepago')->nullable();
            $table->string('numeroguia')->nullable();


            $table->unsignedBigInteger('customersupplier_id')->nullable();
            $table->foreign('customersupplier_id')->references('id')->on('customersuppliers')->onDelete('cascade');

            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');

            $table->unsignedBigInteger('typevoucher_id')->nullable();
            $table->foreign('typevoucher_id')->references('id')->on('typevouchers')->onDelete('cascade');

            $table->unsignedBigInteger('typeoperation_id')->nullable();
            $table->foreign('typeoperation_id')->references('id')->on('typeoperations')->onDelete('cascade');


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
        Schema::dropIfExists('comprobantesales');
    }
};
