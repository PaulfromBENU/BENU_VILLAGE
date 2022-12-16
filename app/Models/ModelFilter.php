<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelFilter extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_couture';

    protected $guarded = ['id'];

    protected $fillable = ['session_id'];
}
