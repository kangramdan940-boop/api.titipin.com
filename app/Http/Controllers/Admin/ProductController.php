<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $events = Event::all();
        return view('admin.products.form', compact('categories', 'events'))->with('product', new Product);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'event_id' => 'nullable|exists:events,id',
            'price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'emoji' => 'nullable|string',
            'gradient' => 'nullable|string',
            'video_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['name']);
        Product::create($data);

        return redirect('/admin/products')->with('success', 'Produk ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $events = Event::all();
        return view('admin.products.form', compact('product', 'categories', 'events'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'event_id' => 'nullable|exists:events,id',
            'price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'emoji' => 'nullable|string',
            'gradient' => 'nullable|string',
            'video_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $product->update($data);

        return redirect('/admin/products')->with('success', 'Produk diupdate');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/admin/products')->with('success', 'Produk dihapus');
    }
}
