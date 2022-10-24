<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'type',
    //     'description_de',
    //     'description_en',
    //     'description_fr',
    //     'description_lu',
    //     'address',
    //     'phone',
    //     'website',
    //     'email',
    //     'picture',
    //     'opening_monday',
    //     'opening_tuesday',
    //     'opening_wednesday',
    //     'opening_thursday',
    //     'opening_friday',
    //     'opening_saturday',
    //     'opening_sunday',
    //     'filter_key',
    // ];

    protected $guarded = ['id'];

    public function articles()
    {
        return $this->belongsToMany(Article::class)->withPivot('stock')->withTimestamps();
    }

    public function articles_in_stock()
    {
        return $this->belongsToMany(Article::class)->wherePivot('stock', '>', '0')->withTimestamps()->withPivot(['stock', 'stock_in_cart']);
    }
}
