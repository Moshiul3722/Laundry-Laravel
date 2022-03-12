<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderManager extends Model
{
    use HasFactory;
    protected $table = "order_managers";
    protected $fillable = ['order_detail_id','order_item_id'];
}
