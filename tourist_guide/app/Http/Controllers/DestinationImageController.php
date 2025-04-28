<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationImageController extends Controller
{
    // public function index() {
    //     $destination_image = DestinationImage::all();
    //     return response()->json($destination_image, 200);
    // }
    // public function store(Request $request) {
    //     $validated = $request->validate([
    //         'destination_id' => 'required|exists:destinations,id',
    //         'image_path' => 'required|url'
    //     ]);
    //     $destination_image= DestinationImage::create($validated);
    //     return response()->json(['Destination Images Added Seccssfuly',$destination_image], 200);
    // }

    // public function update(Request $request,$id) {
    //     $destination_image = DestinationImage::findOrFail($id);
    //     $validated = $request->all();
    //     $destination_image ->update($validated);
    //     return response()->json(['Destination Images Updated Seccssfuly',$destination_image], 200);
    // }

    // public function show($id) {
    //     $destination_image = DestinationImage::findOrFail($id);
    //     return response()->json($destination_image, 200);
    // }

    // public function destroy($id) {
    //     $agency = Destination::findOrFail($id);
    //     $agency->delete();
    //     return response()->json('Destination Image Deleted Seccssfuly', 200);
    // }

    public function DeleteImage($id) {
        $image = DestinationImage::findOrFail($id);

        if(Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        return response()->json('Selected Image Deleted Seccssfuly', 200);
    }
}
