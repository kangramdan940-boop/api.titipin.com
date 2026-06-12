<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
            'pin' => 'required|string|size:6|regex:/^[0-9]+$/',
        ]);

        if (!$request->phone && !$request->email) {
            return response()->json(['message' => 'Phone or email is required'], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->pin),
        ]);

        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'message' => 'Registered successfully',
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'pin' => 'required|string|size:6',
        ]);

        $user = User::where('phone', $request->identifier)
            ->orWhere('email', $request->identifier)
            ->first();

        if (!$user || !Hash::check($request->pin, $user->password)) {
            return response()->json(['message' => 'Nomor/email atau PIN salah'], 401);
        }

        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
