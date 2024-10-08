<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;
    public function earnings()
    {
        return $this->hasMany(Earning::class);
    }
    public function investment(){
        return $this->hasMany(Investment::class);
    }


    public function expence(){
        return $this->hasMany(Expence::class);
    }

    public function totalpayment(){
        return $this->hasMany(total_payment::class);
    }
}
