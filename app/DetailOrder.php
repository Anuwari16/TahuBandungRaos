<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table = "detail_order";
    protected $fillable = ['no_order', 'kd_brg', 'qty_order','subtotal'];

}
