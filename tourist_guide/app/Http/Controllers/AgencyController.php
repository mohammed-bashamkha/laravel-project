<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgencyRequest;
use App\Http\Requests\UpdateAgencyRequest;
use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index() {
        $agency = Agency::all();
        return response()->json($agency, 200);
    }
    public function store(StoreAgencyRequest $request) {
        $validated = $request->validated();
        $agency = Agency::create($validated);
        return response()->json(['Agency Added Seccssfuly',$agency], 200);
    }

    public function update(UpdateAgencyRequest $request,$id) {
        $agency = Agency::findOrFail($id);
        $validated = $request->all();
        $agency ->update($validated);
        return response()->json(['Agency Updated Seccssfuly',$agency], 200);
    }

    public function show($id) {
        $agency = Agency::findOrFail($id);
        return response()->json($agency, 200);
    }

    public function destroy($id) {
        $agency = Agency::findOrFail($id);
        $agency->delete();
        return response()->json('Agency Deleted Seccssfuly', 200);
    }
}
