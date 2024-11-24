<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    protected $primaryKey = 'no_order';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "pre_order";
    protected $fillable = ['no_order', 'tgl_order', 'total', 'kd_agen'];
}
