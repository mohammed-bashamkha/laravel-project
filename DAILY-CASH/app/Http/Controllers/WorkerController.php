<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Auth::user()->workers;
        return response()->json($workers);
    }

    public function store(StoreWorkerRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $worker = Worker::create($validated);

        return response()->json($worker, 201);
    }

    public function update(UpdateWorkerRequest $request, $id)
    {
        $worker = Worker::find($id);
        if (!$worker || $worker->user_id !== Auth::id()) {
            return response()->json(['message' => 'Worker not found or unauthorized'], 404);
        }

        $validated = $request->validated();
        $worker->update($validated);

        return response()->json($worker);
    }

    public function show($id)
    {
        $worker = Worker::find($id);
        if (!$worker || $worker->user_id !== Auth::id()) {
            return response()->json(['message' => 'Worker not found or unauthorized'], 404);
        }
        return response()->json($worker);
    }

    public function destroy($id)
    {
        $worker = Worker::find($id);
        if (!$worker || $worker->user_id !== Auth::id()) {
            return response()->json(['message' => 'Worker not found or unauthorized'], 404);
        }
        $worker->delete();
        return response()->json(['message' => 'Worker deleted successfully']);
    }
}
