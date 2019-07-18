<?php

namespace App\Transformers\Frontend\Goal;

use League\Fractal\TransformerAbstract;
use App\Models\Goal\GoalLog;
class GoalLogTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(GoalLog $goalLog)
    {
        return [
            'description'=>$goalLog->description,
            'properties'=>$goalLog->properties,
            'created_at'=>$goalLog->created_at->toDateTimeString(),
            'updated_at'=>$goalLog->updated_at->toDateTimeString(),
        ];
    }
}
