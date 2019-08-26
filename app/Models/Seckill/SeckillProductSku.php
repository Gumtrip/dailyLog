<?php

namespace App\Models\Seckill;

use Illuminate\Database\Eloquent\Model;

class SeckillProductSku extends Model
{
    protected $fillable=['stock'];
    function seckillProduct(){
        return $this->belongsTo(SeckillProduct::Class);
    }
}
