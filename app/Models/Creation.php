<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creation extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_couture';

    protected $guarded = ['id'];

    public function creation_groups()
    {
        return $this->belongsToMany('App\Models\CreationGroup')->where('creation_groups.filter_key', '<>', 'accessories');
    }

    public function creation_category()
    {
        return $this->belongsTo('App\Models\CreationCategory');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\Partner');
    }

    public function creation_accessories()
    {
        return $this->hasMany('App\Models\Article')->where('is_extra_accessory', '1');
    }

    public function all_articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Article')->where('is_extra_accessory', '0')->where('checked', '1');
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class);
    }

    public function item_orders()
    {
        return $this->hasMany(ItemOrder::class);
    }

    public function mask_orders()
    {
        return $this->hasMany(MaskOrder::class);
    }
}
