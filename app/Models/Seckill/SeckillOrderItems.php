<?php

namespace App\Models\Seckill;

use Illuminate\Database\Eloquent\Model;

class SeckillOrderItems extends Model
{
    protected $fillable=['price','amount'];


    function seckillOrder(){
        return $this->belongsTo(SeckillOrder::Class);
    }

    function seckillProduct(){
        return $this->belongsTo(SeckillProduct::Class);
    }



}
