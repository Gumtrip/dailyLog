<?php

namespace App\Http\Controllers\Api\Backend\Article;

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

    public function update(ArticleRequest $request,Article $article){
        $article->update($request->all());
        return $this->response()->item($article,new ArticleTransformer());

    }
    public function store(ArticleRequest $request,Article $article){
        $article->fill($request->all());
        $article->articleCategory()->associate($request->article_category_id);
        $article->save();
        return $this->response()->item($article,new ArticleTransformer())->setStatusCode(201);
    }

    public function destroy(Request $request,Article $article){
        $article->delete();
        return $this->response->noContent();
    }

}
