<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = "order_items";
    protected $fillable = [
        'order_detail_id',
        'category_id',
        'item_id',
        'qty',
        'area_id',
        'vendor_id',
        'item_process'
    ];
    public $timestamps = false;
}
