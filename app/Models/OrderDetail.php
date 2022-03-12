<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $fillable = [
        'user_id',
        'orderNo',
        'city_id',
        'area_id',
        'staff_id',
        'required_services',
        'pick_up_date',
        'pick_up_time',
        'delivery_date',
        'delivery_time',
        'pay_type',
        'postCode',
        'customerAddress',
        'message',
        'picked_up',
        'status',
        'payment_type'
    ];
}
