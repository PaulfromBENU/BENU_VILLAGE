<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticleElement extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql';

    public function news_article()
    {
        return $this->belongsTo(NewsArticle::class);
    }
}
