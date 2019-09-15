<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image\Image;
class Article extends Model
{
    protected $fillable=['title','article_category_id','content'];
    public function article_category(){
        return $this->belongsTo(ArticleCategory::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
