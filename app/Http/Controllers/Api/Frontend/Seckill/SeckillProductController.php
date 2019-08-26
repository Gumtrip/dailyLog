<?php

namespace App\Http\Controllers\Api\Frontend\Seckill;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Models\Seckill\SeckillProduct;
class SeckillProductController extends Controller
{
    function setStock(Request $request,SeckillProduct $seckillProduct){
        $stock = $request->stock;
        $seckillProduct->update(['stock'=>$stock]);
        $diff =strtotime($seckillProduct->end_date) - time();
        cache(['seckillProduct-1'=>$stock],$diff);
        return $this->response->created(null,'成功设置库存'.$stock);
    }
    function getStock(Request $request,SeckillProduct $seckillProduct){
        $stock = cache('seckillProduct-'.$seckillProduct->id);
        return $this->response->created(null,$stock);
    }
}
