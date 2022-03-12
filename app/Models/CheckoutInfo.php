<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutInfo extends Model
{
    use HasFactory;
    protected $table = "checkout_infos";
    protected $fillable = [
        'user_id',
        'order_detail_id',
        'grandTotal',
        'paid',
        'due',
        'status'
    ];
}
