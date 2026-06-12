@extends('admin.layouts.app')
@section('title', 'Produk')
@section('header', 'Kelola Produk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-slate-500">{{ $products->total() }} produk</p>
    <a href="/admin/products/create" class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg transition">+ Tambah Produk</a>
</div>

<div class="glass rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Produk</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Kategori</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Harga PRJ</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Harga Normal</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Stok</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($products as $product)
                <tr class="hover:bg-white/30 transition">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">{{ $product->emoji }}</span>
                            <span class="font-medium">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-slate-500">{{ $product->category->name ?? '-' }}</td>
                    <td class="px-5 py-3 font-semibold text-cyan-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-5 py-3 text-slate-400 line-through">Rp {{ number_format($product->original_price, 0, ',', '.') }}</td>
                    <td class="px-5 py-3">{{ $product->stock }}</td>
                    <td class="px-5 py-3 flex gap-2">
                        <a href="/admin/products/{{ $product->id }}/edit" class="text-cyan-600 text-xs font-medium hover:underline">Edit</a>
                        <form action="/admin/products/{{ $product->id }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">@csrf @method('DELETE')<button class="text-red-500 text-xs font-medium hover:underline">Hapus</button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div class="px-5 py-3 border-t border-white/30">{{ $products->links() }}</div>
    @endif
</div>
@endsection
