<?php

namespace App\Transformers\Article;

use League\Fractal\TransformerAbstract;
use App\Model\Article\Article;
class ArticleTransformer extends TransformerAbstract
{
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
            'description'=>$article->description,
            'created_at'=>$article->created_at->toDateTimeString(),
            'updated_at'=>$article->updated_at->toDateTimeString(),
        ];
    }
}
