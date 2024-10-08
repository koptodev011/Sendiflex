<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_title',
        'test_id',
        'option1',
        'option2',
        'option3',
        'option4',
        'answer',
        'is_delete',
    ];

}
