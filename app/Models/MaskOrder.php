<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaskOrder extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function creation()
    {
        return $this->belongsTo(Creation::class);
    }
}
