<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = "vendors";
    protected $fillable = [
        'area_id',
        'ven_name',
        'ven_phone',
        'shop_name',
        'shop_address',
        'status'
    ];
}
