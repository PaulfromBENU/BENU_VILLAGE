<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_common';

    protected $guarded = [];

    public function couture_variations()
    {
        if(App::environment('stage')) {
            return $this->belongsToMany(Article::class, 'benu_common_stage.couture_article_cart')->withPivot('is_gift', 'with_wrapping', 'with_card', 'card_type', 'with_message', 'message', 'with_extra_article', 'articles_number', 'value');
        }
        return $this->belongsToMany(Article::class, 'benu_common.couture_article_cart')->withPivot('is_gift', 'with_wrapping', 'with_card', 'card_type', 'with_message', 'message', 'with_extra_article', 'articles_number', 'value');
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
