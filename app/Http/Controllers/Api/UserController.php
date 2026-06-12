<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return response()->json($request->user()->load('addresses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $request->user()->id,
        ]);

        $request->user()->update($request->only('name', 'email'));
        return response()->json($request->user());
    }

    public function addresses(Request $request)
    {
        return response()->json($request->user()->addresses);
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'label' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'required|string',
            'is_default' => 'boolean',
        ]);

        if ($request->is_default) {
            $request->user()->addresses()->update(['is_default' => false]);
        }

        $address = $request->user()->addresses()->create($request->all());
        return response()->json($address, 201);
    }
}
