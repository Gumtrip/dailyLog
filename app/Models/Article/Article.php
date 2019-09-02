<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable=['title','article_category_id','description'];
    public function articleCategory(){
        return $this->belongsTo(ArticleCategory::class);
    }
}
