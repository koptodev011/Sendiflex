<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_name',
        'car_number',
        'fuel_type',
        'active',
        'isdelete',
        'branch'
    ];

}
