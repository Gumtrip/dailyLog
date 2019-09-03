<?php

namespace App\Http\Requests\Backend\Article;

use App\Http\Requests\Backend\BackendRequest as FormRequest;
class ArticleRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|string',
            'article_category_id' => 'required|string',
            'description' => 'required|string',
        ];

        return $rules;

    }
}
