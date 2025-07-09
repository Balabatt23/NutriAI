<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyCalorie extends Model
{
    protected $fillable = [
        'date', 'calories_in', 'calories_out', 'recommended_calories', 'calorie_deficit', 'user_id'
    ];
}
