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

    public function update(Request $request, $id) {
        $user_id = Auth::user();
        $entry = JourbalEntry::findOrFail($id);
        if ($entry->user_id !== $user_id->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Validate the request data
        $data = $request->validate([
            'date' => 'somtimes|date',
            'amount' => 'sometimes|numeric',
            'description' => 'sometimes|string|max:255',
            'debit_entity_id' => 'required|exists:entities,id',
            'credit_entity_id' => 'required|exists:entities,id',
            'revenue_expense_id' => 'nullable|exists:revenues_expenses,id',
        ]);
        $data['user_id'] = $user_id;
        // Update the journal entry
        $entry = JourbalEntry::update($data);

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
}
