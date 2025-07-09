<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyConsumption extends Model
{
    protected $fillable = [
        'food_name', 'calories', 'user_id'
    ];
}
