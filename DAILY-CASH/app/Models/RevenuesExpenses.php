<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevenuesExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'date',
        'amount',
        'description',
        'entity_id',
        'created_by',
    ];

    /**
     * الكيان المرتبط (عامل أو مشروع)
     */
    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    /**
     * المستخدم الذي أنشأ العملية
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
