<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticleElementCouture extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_couture';

    // Real table name
    protected $table = 'news_article_elements';

    public function news_article()
    {
        return $this->belongsTo(NewsArticleCouture::class);
    }
}
