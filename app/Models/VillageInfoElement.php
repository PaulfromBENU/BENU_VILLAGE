<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageInfoElement extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_village';

    public function news_article()
    {
        return $this->belongsTo(VillageInfo::class);
    }
}
