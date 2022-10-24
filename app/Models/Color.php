<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function clothes()
    {
        return $this->hasMany(Article::class)->has('available_shops')->whereHas('creation', function($query) {
            $query->where('is_accessory', '0')->whereHas('creation_groups', function($q) {
                $q->where('filter_key', '<>', 'home');
            });
        });
    }

    public function accessories()
    {
        return $this->hasMany(Article::class)->has('available_shops')->whereHas('creation', function($query) {
            $query->where('is_accessory', '1');
        });
    }

    public function home()
    {
        return $this->hasMany(Article::class)->has('available_shops')->whereHas('creation', function($query) {
            $query->whereHas('creation_groups', function($q) {
                $q->where('filter_key', 'home');
            });
        });
    }
}
