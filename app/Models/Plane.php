<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_',
        'car_number',
        'fuel_type',
        'active',
        'branch'
    ];
}
