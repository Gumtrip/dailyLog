<?php

namespace App\Transformers\Frontend\Seckill;

use League\Fractal\TransformerAbstract;
use App\Models\Seckill\SeckillProduct;
class SeckillProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(SeckillProduct $seckillProduct)
    {
        return [
            'name'=>$seckillProduct->name,
            'start_date'=>$seckillProduct->start_date,
            'end_date'=>$seckillProduct->end_date,
            'stock'=>$seckillProduct->stock,
        ];
    }
}
