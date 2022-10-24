<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composition extends Model
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
    //     'fabric_de',
    //     'fabric_en',
    //     'fabric_fr',
    //     'fabric_lu',
    //     'explanation_de',
    //     'explanation_en',
    //     'explanation_lu',
    //     'explanation_fr',
    //     'picture',
    // ];

    protected $guarded = ['id'];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
