<?php

namespace App\Http\Controllers;

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
            'date' => 'required|date',
            'notes' => 'nullable|string',
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
            'entity_id' => 'required|exists:entities,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $revenuesExpense = RevenuesExpenses::create($data);
        return response()->json($revenuesExpense, 201);
    }
}
