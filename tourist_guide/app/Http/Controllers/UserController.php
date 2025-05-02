<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'تم تعديل المستخدم');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function show($id) {
        $agencies = User::findOrFail($id);
        return view('users.show', compact('users'));
    }

    public function destroy($id) {
        if($destination =! User::find($id))
        {
            return response()->json(['message' =>'User was Deleted'], 200);
        }
        $destination = User::findOrFail($id);
        $destination->delete();
        // return response()->json('Destination Deleted Seccssfuly', 200);
        return redirect()->route('users.index');
    }







    public function register(Request $request) {
        $user = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'required|string'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        // return response()->json([
        //     'message' => 'User Registered Succssfully.',
        //     'User' => $user
        // ], 201);
        return redirect('/login')->with('message', 'User Registered Succssfully.');
    }

    public function login(Request $request) {
        $user = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if(Auth::attempt($request->only('email','password')))
        {
            $user = User::where('email',$request->email)->first();
            $token = $user->createToken('auth_login')->plainTextToken;
            // return response()->json([
            //     'message' => 'User Login Succssfully.',
            //     'User' => $user,
            //     'Token' => $token
            // ], 201);
            return redirect('/')->with('message', 'User Login Succssfully.')->with('token', $token);
        }
        else {
            return response()->json([
                'message' => 'invalid user or password',
            ], 401);
        }
    }
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'User LogOut Succssfully.']);
    }
}
