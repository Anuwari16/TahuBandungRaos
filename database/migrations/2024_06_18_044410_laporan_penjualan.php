<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaporanPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_penjualan', function (Blueprint $table){
            $table->string('no_jual',16);
            $table->date('tgl_lap');
            $table->string('kd_brg',5);
            $table->integer('qty_jual');
            $table->integer('sub_jual');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
