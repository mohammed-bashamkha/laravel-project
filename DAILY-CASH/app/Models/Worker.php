<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'job_title',
        'daily_wage',
        'monthly_wage',
        'phone',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
