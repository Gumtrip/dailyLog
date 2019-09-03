<?php

namespace App\Transformers\Article;

use League\Fractal\TransformerAbstract;
use App\Models\Article\ArticleCategory;
class ArticleCategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(ArticleCategory $articleCategory)
    {
        return [
            'id'=>$articleCategory->id,
            'title'=>$articleCategory->title,
            'created_at'=>$articleCategory->created_at->toDateTimeString(),
            'updated_at'=>$articleCategory->updated_at->toDateTimeString(),
        ];
    }
}
