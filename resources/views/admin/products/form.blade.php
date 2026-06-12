@extends('admin.layouts.app')
@section('title', $product->id ? 'Edit Produk' : 'Tambah Produk')
@section('header', $product->id ? 'Edit Produk' : 'Tambah Produk')

@section('content')
<a href="/admin/products" class="text-sm text-cyan-600 font-medium hover:underline mb-6 inline-block">← Kembali</a>

<div class="glass rounded-2xl p-6 shadow-sm max-w-2xl">
    @if($errors->any())
        <div class="bg-red-50 text-red-600 text-sm p-3 rounded-xl mb-4">{{ $errors->first() }}</div>
    @endif
    <form action="{{ $product->id ? '/admin/products/'.$product->id : '/admin/products' }}" method="POST" class="space-y-4">
        @csrf
        @if($product->id) @method('PUT') @endif

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20" required>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Kategori</label>
                <select name="category_id" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Harga PRJ (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20" required>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Harga Normal (Rp)</label>
                <input type="number" name="original_price" value="{{ old('original_price', $product->original_price) }}" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20" required>
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 10) }}" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20" required>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Emoji</label>
                <input type="text" name="emoji" value="{{ old('emoji', $product->emoji) }}" placeholder="📱" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Event</label>
                <select name="event_id" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20">
                    <option value="">— Tidak ada —</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ old('event_id', $product->event_id) == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-medium text-slate-600 mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Video URL</label>
                <input type="url" name="video_url" value="{{ old('video_url', $product->video_url) }}" placeholder="https://youtube.com/embed/..." class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Gradient CSS</label>
                <input type="text" name="gradient" value="{{ old('gradient', $product->gradient) }}" placeholder="from-cyan-400 to-blue-500" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20">
            </div>
        </div>

        <button class="w-full bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold py-3 rounded-xl shadow-md hover:shadow-lg transition">
            {{ $product->id ? 'Update Produk' : 'Simpan Produk' }}
        </button>
    </form>
</div>
@endsection
