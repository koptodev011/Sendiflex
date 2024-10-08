<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'trainer_id',
        'expense_title',
        'expense_amount',
        'profile_photo_path',
    ];


    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path != null ? url(Storage::url($this->profile_photo_path)) : null;

    }
    
}
