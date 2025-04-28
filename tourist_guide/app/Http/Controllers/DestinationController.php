<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
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
        return response()->json(['Destination Added Seccssfuly',$destination], 200);
    }

    public function update(UpdateDestinationRequest $request,$id) {
        $destination = Destination::findOrFail($id);
        $validated = $request->all();
        $destination ->update($validated);
        return response()->json(['Destination Updated Seccssfuly',$destination], 200);
    }

    public function show($id) {
        $destination = Destination::findOrFail($id);
        return response()->json($destination, 200);
    }

    public function destroy($id) {
        if($destination =! Destination::find($id))
        {
            return response()->json(['message' =>'Destination was Deleted'], 200);
        }
        $destination = Destination::findOrFail($id);
        $destination->delete();
        return response()->json('Destination Deleted Seccssfuly', 200);
    }
}
