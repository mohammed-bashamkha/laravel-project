<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBoxController extends Controller
{
    public function index()
    {
        $cash = Cashbox::all();
        return response()->json($cash);
    }

    public function store(Request $request) {
        $user_id = Auth::user()->id;
         $request->validate([
            'balance' => 'required|numeric'
        ]);
    }
}
