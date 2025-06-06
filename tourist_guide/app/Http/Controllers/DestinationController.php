<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    public function index() {
        $destinations = Auth::user()->destinations;
        // $destinations = Destination::with('images')->get();
        // return response()->json($destination, 200);
        return view('destinations.index', compact('destinations'));
    }
    public function store(StoreDestinationRequest $request) {
        $user_id = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id']=$user_id;
        $destination = Destination::create($validatedData);

        if ($request->has('agencies')) {
            $destination->agencies()->sync($request->agencies);
        }

        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $path = $image->store('destinations' , 'public');

                DestinationImage::create([
                    'destination_id' =>$destination->id,
                    'image_path' => $path
                ]);
            }
        }
        // return response()->json([
        //     'Message'=> 'Destination Added Seccssfuly with Images',
        //     'Destination' => $destination->load('images'),
        //     'Information' => $destination
        // ], 201);
        return redirect()->route('destinations.index');
    }

    public function create() {
        $agencies = \App\Models\Agency::all();
        return view('destinations.create', compact('agencies'));

    }

    public function update(UpdateDestinationRequest $request,$id) {
        $user_id = Auth::user()->id;
        $destination = Destination::find($id);

        if($destination->user_id != $user_id) {
            // return redirect()->route('destinations.index')->with('error',);
            return back()->withErrors('لاتمتلك التصريح لتعديل هذه الوجهة');
        }
        $validated = $request->all();
        $destination ->update($validated);
        $destination->agencies()->sync($request->agencies ?? []);
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $path = $image->store('destinations' , 'public');

                DestinationImage::create([
                    'destination_id' =>$destination->id,
                    'image_path' => $path
                ]);
            }
        }
        // return response()->json([
        //     'Message'=> 'Destination Updated Seccssfuly',
        //     'Destination' => $destination->load('images'),
        //     'Information' => $destination
        // ], 200);
        return redirect()->route('destinations.update');
    }
    public function edit($id) {
        $destination = Destination::with('agencies')->find($id);
        $agencies = \App\Models\Agency::all();
        return view('destinations.edit', compact('destination', 'agencies'));

    }


    public function show($id) {
        $destination = Destination::with(['images','agencies'])->findOrFail($id);
        return response()->json($destination, 200);
    }

    public function destroy($id) {
        $user_id = Auth::user()->id;
        $destination = Destination::findOrFail($id);
        if($destination->user_id != $user_id) {
            // return redirect()->route('destinations.index')->with('error',);
            return back()->withErrors('لاتمتلك التصريح لحذف هذه الوجهة');
        }
        $destination->delete();
        // return response()->json('Destination Deleted Seccssfuly', 200);
        return redirect()->route('destinations.index');
    }

    // دالة عرض كل الوجهات في صفحة Blade
public function viewDestinations()
{
    $destinations = Destination::with('images')->get();
    return view('destinations.index', compact('destinations'));
}

// دالة عرض تفاصيل وجهة معينة في صفحة Blade
public function viewDestination($id)
{
    $destination = Destination::with(['images', 'agencies'])->findOrFail($id);
    return view('destinations.show', compact('destination'));
}


}
