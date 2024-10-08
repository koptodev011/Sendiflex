<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rto_Works extends Model
{
    use HasFactory;
    protected $table = 'rto_works';


   protected $fillable = [
       'name',
       'email',
       'phone',
       'rto_topic',
       'other',
       'branch_id'
   ];
}
