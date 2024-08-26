<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('masteratk_id');
        $table->date('tanggal_request');
        $table->unsignedBigInteger('validation_id')->nullable();
        $table->integer('quantity');
        $table->unsignedBigInteger('unit_id');
        $table->string('status')->default('pending'); // pending, approved, rejected
        $table->timestamps();

        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('masteratk_id')->references('id')->on('masteratk')->onDelete('cascade');
        $table->foreign('unit_id')->references('id')->on('unit')->onDelete('cascade');
        $table->foreign('validation_id')->references('id')->on('validations')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
