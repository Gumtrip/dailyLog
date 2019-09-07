<?php

namespace App\Http\Controllers\Api\Frontend\Article;

use App\Http\Requests\Backend\BackendRequest as Request;
use App\Http\Requests\Backend\Article\ArticleRequest;
use App\Http\Controllers\Api\Controller;
use App\Models\Article\Article;
use App\Transformers\Article\ArticleTransformer;
class ArticleController extends Controller
{


    public function index(Request $request,Article $article){
        $pageSize = $request->page_size??config('app.pagination');
        $query = $article->query();
        $articles = $query->orderBy('id','desc')->paginate($pageSize);
        return $this->response()->paginator($articles,new ArticleTransformer());
    }

    public function show(Request $request,Article $article){
        return $this->response()->item($article,new ArticleTransformer());
    }



}
