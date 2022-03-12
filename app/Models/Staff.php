<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = "staff";
    protected $fillable = [
        'staff_name',
        'staff_phone',
        'staff_role',
        'address',
        'status'
    ];
}
