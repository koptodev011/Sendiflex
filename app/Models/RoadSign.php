<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadSign extends Model
{
    protected $fillable = ['name', 'description', 'parent_id','symbol_image'];

    public function subSigns()
    {
        return $this->hasMany(SubRoadSign::class, 'road_sign_id');
    }
    
}
