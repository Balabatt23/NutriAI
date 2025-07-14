<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verifications extends Model
{
    protected $fillable = [
        'user_id',
        'unique_id',
        'otp',
        'type',
        'send_via',
        'resend',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
