<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jurnal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal', function (Blueprint $table){
            $table->string('no_jurnal',16);
            $table->string('keterangan',100);
            $table->date('tgl_jurnal');
            $table->string('no_akun',5);
            $table->integer('debet');
            $table->integer('kredit');
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
