<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyCalorie extends Model
{
    protected $fillable = [
        'calories_in', 'calories_out', 'recommended_calories', 'user_id'
    ];
}
