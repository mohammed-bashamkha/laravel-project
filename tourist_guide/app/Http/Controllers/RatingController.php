<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $destination_id)
{
    $request->validate([
        'stars' => 'required|integer|min:1|max:5'
    ]);

    Rating::updateOrCreate([
            'user_id' => Auth::user()->id, 'destination_id' => $destination_id],
        ['stars' => $request->stars]
    );

    return redirect()->back()->with('success', 'تم تقييم الوجهة بنجاح');
}

}
