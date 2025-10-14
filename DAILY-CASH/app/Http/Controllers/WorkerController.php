<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
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
}
