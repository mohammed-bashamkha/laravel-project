<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_income',
        'total_expense',
        'balance',
    ];

    /**
     * تحديث الرصيد بناءً على نوع العملية
     */
    public static function updateBalance($type, $amount)
    {
        $cashbox = self::first() ?? self::create();

        if ($type === 'income') {
            $cashbox->increment('total_income', $amount);
        } else {
            $cashbox->increment('total_expense', $amount);
        }

        $cashbox->balance = $cashbox->total_income - $cashbox->total_expense;
        $cashbox->save();
    }
    public function user() {
        $this->belongsTo('users');
    }
}
