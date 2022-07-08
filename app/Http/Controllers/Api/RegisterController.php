<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    //Register a new customer
    public function register(Request $request)
    {
        //Custom validation message
        $msg = [
            'email.unique' => 'email already exist.please login',
        ];
        //validated
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ],$msg);

            //Create customer
            $customer = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => "customer",
            ]);
            //create token
            $token = $customer->createToken('auth-token')->plainTextToken;
            //return response
            return response()->json([
                'customer' => $customer,
                'token' => $token,
                'message' => 'Customer created',
            ], 201);
    }
}
