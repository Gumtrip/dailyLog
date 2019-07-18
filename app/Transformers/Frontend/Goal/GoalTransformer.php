<?php

namespace App\Transformers\Frontend\Goal;

use App\Models\Goal\GoalLog;
use League\Fractal\TransformerAbstract;
use App\Models\Goal\Goal;
class GoalTransformer extends TransformerAbstract
{
    protected $availableIncludes=['goalLogs'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Goal $goal)
    {
        return [
            'id'=>$goal->id,
            'title'=>$goal->title,
            'mission_amount'=>$goal->mission_amount,
            'mission_accomplish_amount'=>$goal->mission_accomplish_amount,
            'bonus'=>$goal->bonus,
            'remark'=>$goal->remark,
            'done_at'=>$goal->done_at,
            'cancel_at'=>$goal->cancel_at,
            'fail_at'=>$goal->cancel_at,
            'start_at'=>$goal->start_at,
            'end_at'=>$goal->end_at,
            'can_get_the_awards'=>$goal->can_get_the_awards,
            'created_at'=>$goal->created_at->toDateTimeString(),
            'updated_at'=>$goal->updated_at->toDateTimeString(),
        ];
    }
    public function includeGoalLogs(Goal $goal){
        return $this->collection($goal->goalLogs,new GoalLogTransformer());
    }
}
