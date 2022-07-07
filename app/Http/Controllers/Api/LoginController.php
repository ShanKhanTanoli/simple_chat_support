<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    //it will return customer and token
    public static function CustomerLogin($user)
    {
        //create token
        $token = $user->createToken('auth-token')->plainTextToken;
        //return response
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    //it will return support and token
    public static function SupportLogin($user, $password)
    {
        //if password matches
        if (Hash::check($password, $user->password)) {
            //create token
            $token = $user->createToken('auth-token')->plainTextToken;
            //return response
            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 201);
            //if email or password does not match
        } else return response()->json([
            'message' => 'Check your email or password',
        ], 404);
    }

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
            //if user is a customer
            if ($user->role == "customer") {
                //customer login
                return self::CustomerLogin($user);
            }
            //if user is a support member
            if ($user->role == "support") {
                //support login
                return self::SupportLogin($user, $validated['password']);
            }
            //if not found
        } else return response()->json([
            'message' => 'not found',
        ], 404);
    }
}
