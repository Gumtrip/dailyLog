<?php

namespace App\Transformers\Frontend\Seckill;

use League\Fractal\TransformerAbstract;
use App\Models\Seckill\SeckillOrder;
class SeckillOrderTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(SeckillOrder $seckillOrder)
    {
        return [
            'no'=>$seckillOrder->no,
            'user_id'=>$seckillOrder->user_id,
            'total_amount'=>$seckillOrder->total_amount,
        ];
    }
}
