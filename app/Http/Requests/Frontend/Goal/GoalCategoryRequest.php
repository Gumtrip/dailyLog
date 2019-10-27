<?php

namespace App\Http\Requests\Frontend\Goal;

use App\Http\Requests\Frontend\FormRequest;

class GoalCategoryRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()){

            case 'POST':
                return [
                    'title'=>'required'
                ];
        }
    }
}
