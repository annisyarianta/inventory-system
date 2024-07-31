<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('validations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('request_id');
        // $table->integer('validated_quantity')->nullable();
        // $table->string('status'); // approved, rejected
        // $table->text('comments')->nullable();
        $table->timestamps();

        $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
        // $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validations');
    }
}
