<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_common';

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function invoice_address()
    {
        return $this->belongsTo(Address::class, 'invoice_address_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function couture_articles()
    {
        return $this->hasManyThrough(Article::class, Cart::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    public function pdf_vouchers()
    {
        return $this->hasMany(Voucher::class)->where('type', 'pdf');
    }

    public function clothe_vouchers()
    {
        return $this->hasMany(Voucher::class)->where('type', '<>', 'pdf');
    }
}
