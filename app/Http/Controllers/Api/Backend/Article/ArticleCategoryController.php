<?php

namespace App\Http\Controllers\Api\Backend\Article;

use App\Http\Requests\Backend\BackendRequest as Request;
use App\Http\Controllers\Api\Controller;
use App\Models\Article\ArticleCategory;
use App\Transformers\Article\ArticleCategoryTransformer;

class ArticleCategoryController extends Controller
{

    public function store(Request $request,ArticleCategory $articleCategory){
        dd(111);
        $articleCategory->fill($request->only(['title']));
        $articleCategory->save();
        return $this->response()->item($articleCategory,new ArticleCategoryTransformer())->setStatusCode(201);
    }

}
