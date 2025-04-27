<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDestinationRequest;
use App\Models\Destination;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index() {
        $destination = Destination::all();
        return response()->json($destination, 200);
    }
    public function store(StoreDestinationRequest $request) {
        $validated = $request->validated();
        $destination = Destination::create($validated);
        return response()->json('Destination Added Seccssfuly', 200);
    }
}
