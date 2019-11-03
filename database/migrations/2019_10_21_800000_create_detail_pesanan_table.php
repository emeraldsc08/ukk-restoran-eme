<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pesanan')->unsigned();
            $table->integer('id_menu')->unsigned();
            $table->integer('jumlah')->unsigned();
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id')->on('pesanan')->onDelete('cascade');
            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pesanan');
    }
}
