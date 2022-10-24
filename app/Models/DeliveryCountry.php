<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCountry extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_common';

    protected $guarded = [];
}
