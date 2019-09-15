<?php

namespace App\Transformers\Article;

use League\Fractal\TransformerAbstract;
use App\Models\Article\Article;

class ArticleTransformer extends TransformerAbstract
{
    protected $availableIncludes=['article_category'];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Article $article)
    {
        return [
            'id'=>$article->id,
            'title'=>$article->title,
            'article_category_id'=>$article->article_category_id,
            'content'=>$article->content,
            'created_at'=>$article->created_at->toDateTimeString(),
            'updated_at'=>$article->updated_at->toDateTimeString(),
        ];
    }

    public function includeArticleCategory(Article $article){
        return $this->item($article->article_category,new ArticleCategoryTransformer());
    }
}
