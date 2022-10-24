<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralCondition extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $guarded = [];
}
