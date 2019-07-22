<?php

namespace App\Http\Controllers\Api\Frontend\Goal;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Models\Goal\GoalCategory;
use App\Transformers\Frontend\Goal\GoalCategoryTransformer;
class GoalCategoryController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    public function index(GoalCategory $goalCategory){
        $query = $goalCategory->query();
        $query->where('user_id',$this->user->id);
        $goalCategories = $query->paginate(config('app.pagination'));
        return $this->response->paginator($goalCategories,new GoalCategoryTransformer());
    }
}
