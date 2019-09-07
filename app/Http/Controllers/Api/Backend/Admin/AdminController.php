<?php

namespace App\Http\Controllers\Api\Backend\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Backend\BackendRequest as Request;


class AdminController extends Controller
{
    public function info()
    {
        return $this->response->array([
            'code' => 20000,
            'data' => [
                'avatar' => "https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif",
                'introduction' => "I am a super administrator",
                'name' => "Super Admin",
                'roles'=>['admin']
            ]
        ]);
    }
}
