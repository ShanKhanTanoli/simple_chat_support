<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        //validated
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        //find user with this email
        $user = User::where('email', $request['email'])->first();
        //if user found
        if ($user) {
            //if password matches
            if (Hash::check($validated['password'], $user->password)) {
                //create token
                $token = $user->createToken('auth-token')->plainTextToken;
                //return response
                return response()->json([
                    'user' => $user,
                    'token' => $token,
                    'message' => 'Successfully logged in',
                ], 201);
                //if email or password does not match
            } else return response()->json([
                'message' => 'Check your email or password',
            ], 404);
            //if not found
        } else return response()->json([
            'message' => 'please register',
        ], 404);
    }
}
