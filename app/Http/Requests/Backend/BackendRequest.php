<?php

namespace App\Http\Requests\Backend;

use Dingo\Api\Http\FormRequest as BaseFormRequest;

class BackendRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
//        return auth()->check();
    }


}
