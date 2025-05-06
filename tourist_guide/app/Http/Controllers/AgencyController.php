<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgencyRequest;
use App\Http\Requests\UpdateAgencyRequest;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyController extends Controller
{
    public function index() {
        $agencies = Auth::user()->agencies;
        // $agency = Agency::all();
        // return response()->json($agency, 200);
        return view('agencies.my_index',compact('agencies'));
    }
    public function store(StoreAgencyRequest $request) {
        $user_id = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id']=$user_id;
        Agency::create($validatedData);
        return redirect()->route('agencies.index');
    }

    public function create() {
        return view('agencies.create');
    }

    public function update(UpdateAgencyRequest $request,$id) {
        $user_id = Auth::user()->id;
        $agency = Agency::find($id);

        if($agency->user_id != $user_id) {
            // return redirect()->route('destinations.index')->with('error',);
            return back()->withErrors('لاتمتلك التصريح لتعديل هذه الوكالة');
        }

        $validated = $request->all();
        $agency ->update($validated);
        return redirect()->route('agencies.update');
    }

    public function edit($id) {
        $agency = Agency::findOrFail($id);
        return view('agencies.edit',compact('agency'));
    }

    public function show($id) {
        $agency = Agency::findOrFail($id);
        return response()->json($agency, 200);
    }

    public function destroy($id) {
        $user_id = Auth::user()->id;
        $agency = Agency::find($id);
        if($agency->user_id != $user_id) {
            return back()->withErrors('لاتمتلك التصريح لحذف هذه الوكالة');
        }
        $agency->delete();
        return redirect()->route('agencies.index');
    }

    public function viewAgencies() {
        $agencies = Agency::get();
    return view('agencies.index', compact('agencies'));
    }

    public function viewAgency($id) {
        $agencies = Agency::findOrFail($id);
        return view('agencies.show', compact('agencies'));
    }
}
