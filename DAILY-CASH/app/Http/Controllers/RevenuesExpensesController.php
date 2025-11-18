<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\RevenuesExpenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevenuesExpensesController extends Controller
{
    public function index()
    {
        $revenuesExpenses = Auth::user()->revenuesExpenses;
        return response()->json($revenuesExpenses);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->validate([
            'entity_id' => 'required|exists:entities,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);
        $data['created_by'] = $user_id;

        $revenuesExpense = RevenuesExpenses::create($data);
        return response()->json($revenuesExpense, 201);
    }

    public function update(Request $request,$id) {
        $user_id = Auth::user()->id;
        $revenuesExpenses = RevenuesExpenses::findOrFail($id);
        if($revenuesExpenses->created_by !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $data = $request->validate([
            'entity_id' => 'sometimes|exists:entities,id',
            'type' => 'sometimes|in:income,expense',
            'amount' => 'sometimes|numeric',
            'description' => 'sometimes|nullable|string',
            'date' => 'sometimes|date',
        ]);

        $revenuesExpense = RevenuesExpenses::create($data);
        return response()->json($revenuesExpense, 201);
    }

    public function show($id) {
        $user_id = Auth::user()->id;
        $revenuesExpenses = RevenuesExpenses::findOrFail($id);
        if($revenuesExpenses->created_by !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }else {
            return response()->json($revenuesExpenses);
        }
    }

    public function destroy($id) {
        $user_id = Auth::user()->id;
        $revenuesExpenses = RevenuesExpenses::findOrFail($id);
        if($revenuesExpenses->created_by !== $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }else {
            $revenuesExpenses->delete();
            return response()->json(['message' => 'Deleted successfully']);
        }
    }

    public function RevenuesExpensesSearch(Request $request)
    {
        $user_id = Auth::user()->id;
        if($request->has('created_by') && $request->created_by != $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $query = RevenuesExpenses::query();

        // نوع العملية (income / expense)
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // التاريخ المحدد
        if ($request->has('date')) {
            $query->whereDate('date', $request->date);
        }

        // البحث بين تاريخين
        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // البحث بالنص (description)
        if ($request->has('keyword')) {
            $query->where('description', 'like', '%' . $request->keyword . '%');
        }

        // البحث حسب الكيان
        if ($request->has('entity_id')) {
            $query->where('entity_id', $request->entity_id);
        }

        // المبلغ أكبر من
        if ($request->has('min_amount')) {
            $query->where('amount', '>=', $request->min_amount);
        }

        // المبلغ أصغر من
        if ($request->has('max_amount')) {
            $query->where('amount', '<=', $request->max_amount);
        }

        // المستخدم الذي أضاف العملية
        if ($request->has('created_by')) {
            $query->where('created_by', $request->created_by);
        }

        // ترتيب تنازلي حسب التاريخ
        $query->orderBy('date', 'desc');

        return response()->json($query->get());
    }


    public function getIncomes()
    {
        $user_id = Auth::user()->id;
        $revenuesExpenses = RevenuesExpenses::where('created_by', $user_id)
            ->where('type', 'income')
            ->get();
        return response()->json($revenuesExpenses);
    }

    public function getExpenses()
    {
        $user_id = Auth::user()->id;
        $revenuesExpenses = RevenuesExpenses::where('created_by', $user_id)
            ->where('type', 'expense')
            ->get();
        return response()->json($revenuesExpenses);
    }

    public function getEntityStatement($entity_id)
    {
        // نبحث عن الكيان (عامل / مشروع)
        $entity = Entity::findOrFail($entity_id);

        // جميع العمليات المرتبطة بالكيان
        $transactions = RevenuesExpenses::where('entity_id', $entity_id)
            ->orderBy('date', 'desc')
            ->get();

        // حساب الإجماليات
        $total_income = $transactions->where('type', 'income')->sum('amount');
        $total_expense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $total_income - $total_expense;

        return response()->json([
            'success' => true,
            'entity' => [
                'id' => $entity->id,
                'name' => $entity->name,
                'type' => $entity->type,
            ],
            'totals' => [
                'total_income' => $total_income,
                'total_expense' => $total_expense,
                'balance' => $balance,
            ],
            'transactions' => $transactions
        ]);
    }

    public function getLast5states() {
        $user_id = Auth::user()->id;
        $transactions = RevenuesExpenses::where('created_by', $user_id)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
        return response()->json($transactions);
    }

}
