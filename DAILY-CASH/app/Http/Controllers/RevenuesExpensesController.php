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
}
