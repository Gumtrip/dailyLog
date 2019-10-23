<?php

namespace App\Http\Requests\Backend\Image;

use App\Http\Requests\Backend\BackendRequest as FormRequest;

class ImageRquest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'model' => 'required|string',
            'images' => 'required|mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200'
        ];
    }

    public function attributes(){
        return [
            'model' => '模型',
            'images' => '图片'
        ];
    }

    public function messages()
    {
        return [
            'images.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上',
        ];
    }
}
