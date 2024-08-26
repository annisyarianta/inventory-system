<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtkmasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atkmasuk', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('masteratk_id');
            // $table->string('namabarang');
            $table->integer('jumlahmasuk');
            // $table->string('satuan');
            $table->date('tanggalmasuk');
            $table->integer('hargasatuan'); 
            $table->integer('hargatotal'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atkmasuk');
    }
}
