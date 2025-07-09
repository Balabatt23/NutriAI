<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyWeightHistory extends Model
{
    protected $fillable = [
        'weight', 'user_id'
    ];
}
