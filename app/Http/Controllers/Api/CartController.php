<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $items = $request->user()->carts()->with('product')->get();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $cart = Cart::updateOrCreate(
            ['user_id' => $request->user()->id, 'product_id' => $request->product_id],
            ['quantity' => \DB::raw('quantity + ' . ($request->quantity ?? 1)), 'notes' => $request->notes]
        );

        return response()->json($cart->load('product'), 201);
    }

    public function update(Request $request, string $id)
    {
        $cart = $request->user()->carts()->findOrFail($id);
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cart->update(['quantity' => $request->quantity]);
        return response()->json($cart->load('product'));
    }

    public function destroy(Request $request, string $id)
    {
        $request->user()->carts()->findOrFail($id)->delete();
        return response()->json(['message' => 'Removed']);
    }
}
