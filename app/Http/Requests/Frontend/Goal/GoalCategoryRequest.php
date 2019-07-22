<?php

namespace App\Http\Requests\Frontend\Goal;

use App\Http\Requests\FormRequest;

class GoalCategoryRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required'
        ];
    }
}
