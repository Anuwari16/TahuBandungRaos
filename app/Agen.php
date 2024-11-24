<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agen extends Model
{
    protected $primaryKey = 'kd_agen';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "agen";
    protected $fillable=['kd_agen','nm_agen','telepon','alamat'];
}
