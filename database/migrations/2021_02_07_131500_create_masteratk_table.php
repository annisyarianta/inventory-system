<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasteratkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masteratk', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('namabarang');
            $table->string('kodebarang');
            $table->string('jenisbarang');
            $table->string('satuan');
            $table->string('gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masteratk');
    }
}
