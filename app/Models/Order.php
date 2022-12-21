<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Choice of the database
    protected $connection = 'mysql_common';

    // Informations on statuses
    // 'status' value:
    // 0 => Order created
    // 1 => Order on-going, not paid
    // 2 => Order confirmed, content sold, payment completed or expected (transfer or Payconiq)
    // 3 => Order sent to customer via delivery
    // 4 => Order cancelled
    // 5 => Sold in shop
    //
    // 'payment_status' value:
    // 0 => No payment required
    // 1 => Payment required, not paid yet
    // 2 => Payment received
    //
    // 'delivery_status' value:
    // 0 => No delivery requested
    // 1 => Delivery waiting for confirmation
    // 2 => Delivery on-going - Package sent
    // 3 => Package ready for collect
    // 4 => Delivery not required (in BENU shop)
    // 5 => Collected in shop
    // 10 => Sold in shop

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
