<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBoxController extends Controller
{
    public function index()
    {
        $cash = Cashbox::all();
        return response()->json($cash);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // تحقق هل لدى المستخدم صندوق بالفعل
        if ($user->cashbox) {
            return response()->json([
                'message' => 'You already have a cashbox',
                'cashbox' => $user->cashbox
            ], 400);
        }

        // التحقق من صحة البيانات
        $data = $request->validate([
            'balance' => 'required|numeric',
        ]);

        // إنشاء الصندوق وربطه بالمستخدم
        $cashbox = Cashbox::create([
            'user_id' => $user->id,
            'total_income' => 0,
            'total_expense' => 0,
            'balance' => $data['balance'],
        ]);

        return response()->json([
            'message' => 'Cashbox created successfully',
            'cashbox' => $cashbox
        ], 201);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $cash = $user->cashbox;

        // تحقق أن الصندوق موجود فعلاً
        if (!$cash) {
            return response()->json(['message' => 'Cashbox not found'], 404);
        }

        // تحقق من صحة المدخلات
        $data = $request->validate([
            'balance' => 'sometimes|numeric'
        ]);

        // تحديث الرصيد أو الحقول المطلوبة
        $cash->update($data);

        return response()->json([
            'message' => 'Cashbox updated successfully',
            'cash' => $cash
        ], 200);
    }
}
