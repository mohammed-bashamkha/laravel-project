<?php

namespace App\Http\Controllers;

use App\Models\Cashbox;
use Illuminate\Http\Request;

class CashBoxController extends Controller
{
    public function index()
    {
        $cash = Cashbox::all();
        return response()->json($cash);
    }
}
