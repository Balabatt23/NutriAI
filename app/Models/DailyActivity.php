<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyActivity extends Model
{
    protected $fiilable = [
        'acticity_name', 'calories', 'duration', 'time', 'date', 'user_id'
    ];
}
