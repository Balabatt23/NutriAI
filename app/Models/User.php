<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'birth_date',
        'gender',
        'password',
        
        'weight',
        'height', 
        'weight_target',
        'profile_pic',
        'status',

        'bmi',
        'exercise_frequency',
        'avg_sleep_hours',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'alcohol_consumption',
        'smoking_habit'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function daily_calorie()
    {
        return $this->hasMany(DailyCalorie::class, 'user_id', 'id');
    }

    public function daily_activity()
    {
        return $this->hasMany(DailyActivity::class, 'user_id', 'id');
    }

    public function daily_consumption()
    {
        return $this->hasMany(DailyConsumption::class, 'user_id', 'id');
    }

    public function weight_history()
    {
        return $this->hasMany(BodyWeightHistory::class, 'user_id', 'id');
    }
}
