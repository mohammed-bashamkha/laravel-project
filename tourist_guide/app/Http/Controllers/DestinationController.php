<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index() {
        $destination = Destination::with('images')->all();
        return response()->json($destination, 200);
    }
    public function store(StoreDestinationRequest $request) {
        $validated = $request->validated();
        $destination = Destination::create($validated);
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $path = $image->store('destinations' , 'public');

                DestinationImage::create([
                    'destination_id' =>$destination->id,
                    'image_path' => $path
                ]);
            }
        }
        return response()->json([
            'Message'=> 'Destination Added Seccssfuly with Images',
            'Destination' => $destination->load('images'),
            'Information' => $destination
        ], 201);
    }

    public function update(UpdateDestinationRequest $request,$id) {
        $destination = Destination::findOrFail($id);
        $validated = $request->all();
        $destination ->update($validated);
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $path = $image->store('destinations' , 'public');

                DestinationImage::create([
                    'destination_id' =>$destination->id,
                    'image_path' => $path
                ]);
            }
        }
        return response()->json([
            'Message'=> 'Destination Added Seccssfuly with Images',
            'Destination' => $destination->load('images'),
            'Information' => $destination
        ], 200);
    }

    public function show($id) {
        $destination = Destination::with(['images','agencies'])->findOrFail($id);
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
