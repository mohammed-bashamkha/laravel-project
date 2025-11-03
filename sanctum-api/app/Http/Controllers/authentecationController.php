<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->email and $request->password) {
            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                $token = $user->createToken('API Token For User')->plainTextToken;
                return $this->finalResponse(true, 'User logged successfully', 200, $token,);
            }
        }
        return response()->json(['status' => false, 'error' => 'Incorrect email or password, please try again.'], 200);
    }


    public function register(Request $request)
    {
        if (User::where('email', $request->email)->first()) {
            return response()->json(
                [
                    'status' => false,
                    'error' => 'The email already taken',
                    'message' => 'Failed to register, please try again.'
                ],
                422
            );
        }
        if (! filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(
                [
                    'status' => false,
                    'error' => 'The email is incorrect format. must have @ and .',
                    'message' => 'Email is incorrect format. must have @ and . , please try again.'
                ],
                422
            );
        }

        if ($request->name and $request->email and $request->password) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => now()
            ]);
            $token = $user->createToken('API Token For User')->plainTextToken;
            
            // $user->sendEmailVerificationNotification();
            return $this->finalResponse(true, 'User created successfully', 200, $token, $user);
        }
        return response()->json(
            [
                'status' => false,
                'error' => 'fill the fields',
                'message' => 'Failed to register, please try again.'
            ],
            200
        );
    }

    public function finalResponse($status = true,$message = "success",$statusCode = 200,$accessToken = null,$data = null,$errors = null) {
        return response()->json([
            'status' => true,
            "message" => $message,
            'access-token' => $accessToken,
            "data" => $data,
            'errors' => $errors
        ], $statusCode);
    }
}
