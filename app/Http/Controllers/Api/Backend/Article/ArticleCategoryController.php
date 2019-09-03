<?php

namespace App\Http\Controllers\Api\Backend\Article;

use App\Http\Requests\Backend\BackendRequest as Request;
use App\Http\Controllers\Api\Controller;
use App\Models\Article\ArticleCategory;
use App\Transformers\Article\ArticleCategoryTransformer;
use App\Http\Requests\Backend\Article\ArticleCategoryRequest;
class ArticleCategoryController extends Controller
{

    public function store(ArticleCategoryRequest $request,ArticleCategory $articleCategory){
        $articleCategory->fill($request->all());
        $articleCategory->save();
        return $this->response()->item($articleCategory,new ArticleCategoryTransformer())->setStatusCode(201);
    }

    public function index(Request $request,ArticleCategory $articleCategory){
        $pageSize = $request->page_size??config('app.pagination');
        $query = $articleCategory->query();
        $articles = $query->orderBy('id','desc')->paginate($pageSize);
        return $this->response()->paginator($articles,new ArticleCategoryTransformer());
    }

    public function show(Request $request,ArticleCategory $articleCategory){
        return $this->response()->item($articleCategory,new ArticleCategoryTransformer());
    }

    public function update(ArticleCategoryRequest $request,ArticleCategory $articleCategory){
        $articleCategory->update($request->all());
        return $this->response()->item($articleCategory,new ArticleCategoryTransformer());

    }


    public function destroy(Request $request,ArticleCategory $articleCategory){
        $articleCategory->delete();
        return $this->response->noContent();
    }

}
