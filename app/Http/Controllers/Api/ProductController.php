<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category', 'event')->where('is_active', true);

        if ($request->has('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->has('event')) {
            $query->whereHas('event', fn($q) => $q->where('slug', $request->event));
        }
        if ($request->has('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        return response()->json($query->latest()->paginate($request->get('per_page', 20)));
    }

    public function show(string $id)
    {
        $product = Product::with('category', 'event')->where('slug', $id)->orWhere('id', $id)->firstOrFail();
        return response()->json($product);
    }
}
