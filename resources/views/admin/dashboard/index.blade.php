@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- Stats -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="glass rounded-2xl p-5 shadow-sm">
        <p class="text-2xl font-bold text-cyan-600">{{ $stats['orders'] }}</p>
        <p class="text-xs text-slate-500 mt-1">Total Pesanan</p>
    </div>
    <div class="glass rounded-2xl p-5 shadow-sm">
        <p class="text-2xl font-bold text-amber-500">{{ $stats['processing'] }}</p>
        <p class="text-xs text-slate-500 mt-1">Sedang Diproses</p>
    </div>
    <div class="glass rounded-2xl p-5 shadow-sm">
        <p class="text-2xl font-bold text-emerald-500">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
        <p class="text-xs text-slate-500 mt-1">Revenue</p>
    </div>
    <div class="glass rounded-2xl p-5 shadow-sm">
        <p class="text-2xl font-bold text-violet-500">{{ $stats['users'] }}</p>
        <p class="text-xs text-slate-500 mt-1">Total Users</p>
    </div>
</div>

<!-- Recent Orders -->
<div class="glass rounded-2xl shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-white/30 flex items-center justify-between">
        <h2 class="font-bold">📦 Pesanan Terbaru</h2>
        <a href="/admin/orders" class="text-sm text-cyan-600 font-medium">Lihat semua →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($recentOrders as $order)
                <tr class="hover:bg-white/30 transition">
                    <td class="px-6 py-3 font-medium">{{ $order->order_number }}</td>
                    <td class="px-6 py-3 text-slate-500">{{ $order->user->name ?? '-' }}</td>
                    <td class="px-6 py-3 font-semibold text-cyan-600">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td class="px-6 py-3">
                        @php $colors = ['processing'=>'bg-blue-100 text-blue-600','buying'=>'bg-violet-100 text-violet-600','packing'=>'bg-amber-100 text-amber-600','shipping'=>'bg-cyan-100 text-cyan-600','delivered'=>'bg-emerald-100 text-emerald-600','cancelled'=>'bg-red-100 text-red-600']; @endphp
                        <span class="text-xs font-bold px-2 py-1 rounded-full {{ $colors[$order->status] ?? '' }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td class="px-6 py-3 text-slate-400">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada pesanan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
