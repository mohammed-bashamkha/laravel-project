<?php

namespace App\Http\Controllers;

use App\Models\JourbalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JourbalEntryController extends Controller
{
    public function index() {
        $user = Auth::user()->jourbalEntries;
        return response()->json($user);
    }

    public function store(Request $request) {
        $user_id = Auth::user()->id;

        // Validate the request data
        $data = $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'debit_entity_id' => 'required|exists:entities,id',
            'credit_entity_id' => 'required|exists:entities,id',
            'revenue_expense_id' => 'nullable|exists:revenues_expenses,id',
        ]);
        $data['user_id'] = $user_id;

        // Create the journal entry
        $entry = JourbalEntry::create($data);

        return response()->json($entry, 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $entry = JourbalEntry::findOrFail($id);

        // التحقق من صلاحية المستخدم
        if ($entry->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // التحقق من البيانات
        $data = $request->validate([
            'date' => 'sometimes|date',
            'amount' => 'sometimes|numeric',
            'description' => 'sometimes|string|max:255',
            'debit_entity_id' => 'sometimes|required|exists:entities,id',
            'credit_entity_id' => 'sometimes|required|exists:entities,id',
            'revenue_expense_id' => 'sometimes|nullable|exists:revenues_expenses,id',
        ]);

        // تعديل user_id
        $data['user_id'] = $user->id;

        // تحديث السجل
        $entry->update($data);

        return response()->json($entry, 200);
    }

    public function show($id) {
        $user = Auth::user();
        $entry = JourbalEntry::findOrFail($id);
        if ($entry->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($entry, 200);
    }

    public function destroy($id) {
        $user = Auth::user();
        $entry = JourbalEntry::findOrFail($id);
        if ($entry->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $entry->delete();
        return response()->json(['message' => 'Journal entry deleted successfully'], 200);
    }

    public function journalEntrySearch(Request $request)
    {
        $user_id = Auth::id();

        // منع الوصول لعمليات شخص آخر
        if ($request->filled('created_by') && $request->created_by != $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // بداية الاستعلام
        $query = JourbalEntry::where('user_id', $user_id);

        // كلمة البحث العامة
        if ($request->filled('keyword')) {
            $keyword = '%' . $request->keyword . '%';

            $query->where(function($q) use ($keyword) {
                $q->where('date', 'like', $keyword)
                ->orWhere('description', 'like', $keyword)
                ->orWhere('amount', 'like', $keyword)
                ->orWhere('debit_entity_id', 'like', $keyword)
                ->orWhere('credit_entity_id', 'like', $keyword)
                ->orWhere('revenue_expense_id', 'like', $keyword);
            });
        }

        // تحميل العلاقات + ترتيب حسب التاريخ
        $results = $query->orderBy('date', 'desc')->get();

        return response()->json($results);
    }

}
