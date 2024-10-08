<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance'; // Specify the correct table name if needed

    protected $fillable = [
        'user_id', 'date', 'status', 'month',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
