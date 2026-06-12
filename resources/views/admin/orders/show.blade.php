@extends('admin.layouts.app')
@section('title', 'Detail Pesanan')
@section('header', 'Detail Pesanan #' . $order->order_number)

@section('content')
<a href="/admin/orders" class="text-sm text-cyan-600 font-medium hover:underline mb-6 inline-block">← Kembali</a>

<div class="grid lg:grid-cols-3 gap-6">
    <!-- Order Info -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Items -->
        <div class="glass rounded-2xl p-6 shadow-sm">
            <h3 class="font-bold mb-4">📦 Item Pesanan</h3>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center justify-between py-2 border-b border-slate-100 last:border-0">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">{{ $item->product->emoji ?? '📦' }}</span>
                        <div>
                            <p class="font-medium text-sm">{{ $item->product->name ?? 'Produk' }}</p>
                            <p class="text-xs text-slate-400">x{{ $item->quantity }} • Fee: Rp {{ number_format($item->fee, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-sm">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
            <div class="border-t border-slate-200 mt-4 pt-4 space-y-1 text-sm">
                <div class="flex justify-between"><span class="text-slate-500">Subtotal</span><span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span></div>
                <div class="flex justify-between"><span class="text-slate-500">Fee</span><span>Rp {{ number_format($order->fee, 0, ',', '.') }}</span></div>
                <div class="flex justify-between"><span class="text-slate-500">Ongkir</span><span>Rp {{ number_format($order->ongkir, 0, ',', '.') }}</span></div>
                <div class="flex justify-between font-bold text-base pt-2 border-t border-slate-200"><span>Total</span><span class="text-cyan-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span></div>
            </div>
        </div>

        <!-- Customer -->
        <div class="glass rounded-2xl p-6 shadow-sm">
            <h3 class="font-bold mb-3">👤 Customer</h3>
            <p class="text-sm font-medium">{{ $order->user->name ?? '-' }}</p>
            <p class="text-sm text-slate-500">{{ $order->user->phone ?? '-' }} • {{ $order->user->email ?? '-' }}</p>
            @if($order->address)
            <div class="mt-3 pt-3 border-t border-slate-100 text-sm text-slate-500">
                <p class="font-medium text-slate-700">📍 {{ $order->address->label }}</p>
                <p>{{ $order->address->address }}, {{ $order->address->city }}, {{ $order->address->province }} {{ $order->address->postal_code }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Status Update -->
    <div class="space-y-6">
        <div class="glass rounded-2xl p-6 shadow-sm">
            <h3 class="font-bold mb-4">⚡ Update Status</h3>
            @if(session('success'))
                <div class="bg-emerald-50 text-emerald-600 text-sm p-3 rounded-xl mb-4">{{ session('success') }}</div>
            @endif
            <form action="/admin/orders/{{ $order->id }}/status" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20">
                        @foreach(['processing'=>'Diproses','buying'=>'Sedang Dibeli','packing'=>'Packing','shipping'=>'Dikirim','delivered'=>'Selesai','cancelled'=>'Dibatalkan'] as $val => $label)
                            <option value="{{ $val }}" {{ $order->status == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Ekspedisi</label>
                    <input type="text" name="ekspedisi" value="{{ $order->ekspedisi }}" placeholder="JNE / J&T / SiCepat" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">No. Resi</label>
                    <input type="text" name="resi" value="{{ $order->resi }}" placeholder="Nomor resi" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20">
                </div>
                <button class="w-full bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold py-3 rounded-xl shadow-md hover:shadow-lg transition">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
