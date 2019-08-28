<?php

namespace App\Transformers\Frontend\Seckill;

use League\Fractal\TransformerAbstract;
use App\Models\Seckill\SeckillOrderItems;

class SeckillOrderItemTransformer extends TransformerAbstract
{
    protected $availableIncludes=['seckill_product','seckill_order'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(SeckillOrderItems $seckillOrderItems)
    {
        return [
            'price'=>$seckillOrderItems->price,
            'amount'=>$seckillOrderItems->amount
        ];
    }

    public function includeSeckillProduct(SeckillOrderItems $seckillOrderItems){
        return $this->item($seckillOrderItems->SeckillProduct(),new SeckillProductTransformer());
    }
    public function includeSeckillOrder(SeckillOrderItems $seckillOrderItems){
        return $this->item($seckillOrderItems->SeckillOrder(),new SeckillOrderTransformer());
    }
}
