<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users,email',
            'password' => 'required|string|min:8'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'massage' => 'User Registered Successfuly',
            'User' => $user,
        ],201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User Logged In Successfully',
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    public function logout(Request $request)
{
    $user = $request->user();

    if ($user && $user->currentAccessToken()) {
        $user->currentAccessToken()->delete();
        return response()->json(['message' => 'logged out successfully'], 200);
    }

    return response()->json(['message' => 'The currentAccessToken is Undefiend'], 401);
    }

    public function deleteMyAccount(Request $request) {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete(); // حذف جميع التوكنات المرتبطة بالمستخدم
            $user->delete(); // حذف حساب المستخدم
            return response()->json(['message' => 'Account deleted successfully'], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
