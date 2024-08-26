<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtkkeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atkkeluar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('masteratk_id');
            $table->integer('jumlahkeluar');
            $table->date('tanggalkeluar');
            $table->string('unit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atkkeluar');
    }
}
