<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRoadSign extends Model
{
    protected $fillable = ['name', 'description', 'symbol_image', 'road_sign_id'];

    public function roadSign()
    {
        return $this->belongsTo(RoadSign::class, 'road_sign_id');
    }
}
