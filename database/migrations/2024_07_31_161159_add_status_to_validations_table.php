<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('validations', function (Blueprint $table) {
        $table->string('status')->default('pending');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('validations', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
}
