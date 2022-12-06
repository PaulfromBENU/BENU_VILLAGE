<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramPicture extends Model
{
    use HasFactory;

    protected $connection = 'mysql_common';

    protected $guarded = [];
}
