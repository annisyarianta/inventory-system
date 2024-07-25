<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasukgaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masukga', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('barangga_id');
            $table->integer('jumlahmasuk');
            $table->date('tanggalmasuk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masukga');
    }
}
