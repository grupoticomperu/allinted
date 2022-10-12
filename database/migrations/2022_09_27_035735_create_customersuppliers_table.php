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
        Schema::create('customersuppliers', function (Blueprint $table) {
            $table->id();

            $table->string('numdoc')->unique();
            $table->string('nomrazonsocial')->unique();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('movil')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->boolean('state')->default(true);

            $table->unsignedBigInteger('typedocument_id')->nullable();
            $table->foreign('typedocument_id')->references('id')->on('typedocuments')->onDelete('cascade');


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
        Schema::dropIfExists('customersuppliers');
    }
};
