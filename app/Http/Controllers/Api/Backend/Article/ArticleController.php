<?php

namespace App\Http\Controllers\Api\Backend\Article;

use App\Http\Requests\Backend\BackendRequest as Request;
use App\Http\Controllers\Api\Controller;
use App\Models\Article\Article;
use App\Transformers\Article\ArticleTransformer;
class ArticleController extends Controller
{
    public function index(Request $request){

    }

    public function show(Request $request,Article $article){

    }

    public function update(Request $request){

    }
    public function store(Request $request,Article $article){
        $article->fill($request->only(['title','description']));
        $article->articleCategory()->associate($request->article_category_id);
        $article->save();
        return $this->response()->item($article,new ArticleTransformer())->setStatusCode(201);
    }

    public function destroy(){

    }

}
