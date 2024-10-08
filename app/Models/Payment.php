<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['plan_id', 'user_id', 'payment_provider_response','pending_amount','total_amount','amount'];   

    use HasFactory;
}
