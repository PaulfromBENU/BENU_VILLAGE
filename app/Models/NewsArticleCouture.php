<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticleCouture extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_couture';

    // Real table name
    protected $table = 'news_articles';

    public function elements()
    {
        return $this->hasMany(NewsArticleElementCouture::class);
    }
}
