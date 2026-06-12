<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->orders()->with('items.product')->latest();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return response()->json($query->paginate(20));
    }

    public function show(Request $request, string $id)
    {
        $order = $request->user()->orders()->with('items.product', 'address')->findOrFail($id);
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'nullable|exists:addresses,id',
            'notes' => 'nullable|string',
        ]);

        $cartItems = $request->user()->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 422);
        }

        $subtotal = $cartItems->sum(fn($c) => $c->product->price * $c->quantity);
        $fee = $cartItems->sum(function ($c) {
            $price = $c->product->price;
            $rate = match(true) {
                $price < 500000 => 50000 / $price,
                $price <= 2000000 => 0.10,
                $price <= 10000000 => 0.07,
                default => 0.05,
            };
            return (int) ($price * $rate * $c->quantity);
        });

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => $request->user()->id,
            'address_id' => $request->address_id,
            'subtotal' => $subtotal,
            'fee' => $fee,
            'ongkir' => 0,
            'total' => $subtotal + $fee,
            'status' => 'processing',
            'notes' => $request->notes,
        ]);

        foreach ($cartItems as $cartItem) {
            $price = $cartItem->product->price;
            $itemFee = match(true) {
                $price < 500000 => 50000,
                $price <= 2000000 => (int)($price * 0.10),
                $price <= 10000000 => (int)($price * 0.07),
                default => (int)($price * 0.05),
            };

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $price,
                'fee' => $itemFee,
                'notes' => $cartItem->notes,
            ]);
        }

        // Clear cart
        $request->user()->carts()->delete();

        return response()->json($order->load('items.product'), 201);
    }
}
