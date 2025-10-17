<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourbalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'amount',
        'description',
        'debit_entity_id',
        'credit_entity_id',
        'revenue_expense_id',
    ];

    /**
     * الحساب المدين
     */
    public function debitEntity()
    {
        return $this->belongsTo(Entity::class, 'debit_entity_id');
    }

    /**
     * الحساب الدائن
     */
    public function creditEntity()
    {
        return $this->belongsTo(Entity::class, 'credit_entity_id');
    }

    /**
     * العملية المالية المرتبطة
     */
    public function revenueExpense()
    {
        return $this->belongsTo(RevenuesExpenses::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
