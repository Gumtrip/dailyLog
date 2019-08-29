<?php

namespace App\Http\Controllers\Api\Frontend\Seckill;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Models\Seckill\SeckillProduct;
use App\Transformers\Frontend\Seckill\SeckillProductTransformer;
class SeckillProductController extends Controller
{
    function update(Request $request,SeckillProduct $seckillProduct){
        $stock = $request->stock;
        $seckillProduct->update(['stock'=>$stock]);
        $diff =strtotime($seckillProduct->end_date) - time();
        cache(['seckillProduct-'.$seckillProduct->id=>$stock],$diff);
        return $this->response->item($seckillProduct,new SeckillProductTransformer());
    }
    function show(Request $request,SeckillProduct $seckillProduct){
        return $this->response->item($seckillProduct,new SeckillProductTransformer());
    }
}
