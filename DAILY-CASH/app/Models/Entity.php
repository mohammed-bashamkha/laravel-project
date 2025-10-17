<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'phone',
        'notes',
    ];

    /**
     * العلاقة مع العمليات المالية (الإيرادات والمصروفات)
     */
    public function revenuesExpenses()
    {
        return $this->hasMany(RevenuesExpenses::class);
    }
}
