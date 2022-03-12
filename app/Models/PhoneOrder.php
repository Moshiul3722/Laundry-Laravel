<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneOrder extends Model
{
    use HasFactory;
    protected $table = "phone_orders";
    protected $fillable = [
        'user_id',
        'area_id',
        'required_services',
        'pick_up_date',
        'pick_up_time',
        'pay_type',
        'message'
    ];
}
