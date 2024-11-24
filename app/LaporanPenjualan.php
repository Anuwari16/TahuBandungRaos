<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    protected $primaryKey = 'no_jual';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "laporan_penjualan";
    protected $fillable = ['no_jual','tgl_lap', 'kd_brg', 'qty_jual', 'sub_jual'];
}
