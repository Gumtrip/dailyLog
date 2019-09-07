<?php

namespace App\Http\Controllers\Api\Frontend\Article;

use App\Http\Requests\Backend\BackendRequest as Request;
use App\Http\Controllers\Api\Controller;
use App\Models\Article\ArticleCategory;
use App\Transformers\Article\ArticleCategoryTransformer;
use App\Http\Requests\Backend\Article\ArticleCategoryRequest;

class ArticleCategoryController extends Controller
{



    public function index(Request $request,ArticleCategory $articleCategory){
        $pageSize = $request->page_size??config('app.pagination');
        $query = $articleCategory->query();
        $articles = $query->orderBy('id','desc')->paginate($pageSize);
        return $this->response()->paginator($articles,new ArticleCategoryTransformer());
    }

    public function show(Request $request,ArticleCategory $articleCategory){
        return $this->response()->item($articleCategory,new ArticleCategoryTransformer());
    }




}
