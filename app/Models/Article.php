<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Article extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql';

    protected $guarded = ['id'];

    public function creation()
    {
        return $this->belongsTo('App\Models\Creation');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }

    public function size()
    {
        return $this->belongsTo('App\Models\Size');
    }

    public function shops()
    {
        return $this->belongsToMany(Shop::class)->withPivot('stock')->withTimestamps();
    }

    public function available_shops()
    {
        return $this->belongsToMany(Shop::class)->wherePivot('stock', '>', '0')->withTimestamps();
    }

    public function pending_shops()
    {
        return $this->belongsToMany(Shop::class)->wherePivot('stock_in_cart', '>', '0')->withTimestamps();
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class)->withTimestamps();
    }

    public function wishlistUsers()
    {
        if(App::environment('stage')) {
            return $this->belongsToMany(User::class, 'benu_common_stage.couture_article_user');
        }
        return $this->belongsToMany(User::class, 'benu_common.couture_article_user');
    }

    public function compositions()
    {
        return $this->belongsToMany(Composition::class);
    }

    public function care_recommendations()
    {
        return $this->belongsToMany(CareRecommendation::class);
    }

    public function carts()
    {
        if(App::environment('stage')) {
            return $this->belongsToMany(Cart::class, 'benu_common_stage.couture_article_cart')->withPivot('is_gift', 'with_wrapping', 'with_card', 'card_type', 'with_message', 'message', 'with_extra_article', 'articles_number', 'value');
        }
        return $this->belongsToMany(Cart::class, 'benu_common.couture_article_cart')->withPivot('is_gift', 'with_wrapping', 'with_card', 'card_type', 'with_message', 'message', 'with_extra_article', 'articles_number', 'value');
    }
}
