<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_PreOrder extends Model
{
    protected $primaryKey = 'kd_brg';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "temp_pre_order";
    protected $fillable = ['kd_brg', 'qty_order'];


}
