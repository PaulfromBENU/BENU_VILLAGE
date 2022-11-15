<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageInfo extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_village';

    public function elements()
    {
        return $this->hasMany(VillageInfoElement::class);
    }
}
