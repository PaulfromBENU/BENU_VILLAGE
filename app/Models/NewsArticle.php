<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql';

    public function elements()
    {
        return $this->hasMany(NewsArticleElement::class);
    }
}
