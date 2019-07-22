<?php

namespace App\Transformers\Frontend\Goal;

use League\Fractal\TransformerAbstract;
use App\Models\Goal\GoalCategory;
use App\Models\Goal\Goal;
class GoalCategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes=['goals'];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(GoalCategory $goalCategory)
    {
        return [
            'id'=>$goalCategory->id,
            'title'=>$goalCategory->title,
        ];
    }
    public function includeGoals(GoalCategory $goalCategory){
        return $this->collection($goalCategory->goals,new GoalTransformer());

    }
}
