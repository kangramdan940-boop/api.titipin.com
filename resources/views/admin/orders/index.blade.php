@extends('admin.layouts.app')
@section('title', 'Pesanan')
@section('header', 'Kelola Pesanan')

@section('content')
<!-- Filters -->
<div class="flex flex-wrap gap-2 mb-6">
    @php $statuses = [''=>'Semua','processing'=>'Diproses','buying'=>'Dibeli','packing'=>'Packing','shipping'=>'Dikirim','delivered'=>'Selesai','cancelled'=>'Batal']; @endphp
    @foreach($statuses as $key => $label)
        <a href="/admin/orders{{ $key ? '?status='.$key : '' }}" class="text-xs font-semibold px-4 py-2 rounded-full transition {{ request('status') == $key || (!request('status') && $key == '') ? 'bg-gradient-to-r from-cyan-500 to-teal-500 text-white shadow-sm' : 'glass text-slate-500 hover:text-cyan-600' }}">{{ $label }}</a>
    @endforeach
</div>

<!-- Table -->
<div class="glass rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Order</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Customer</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Total</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Status</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Resi</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Tanggal</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($orders as $order)
                <tr class="hover:bg-white/30 transition">
                    <td class="px-5 py-3 font-medium">{{ $order->order_number }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $order->user->name ?? '-' }}</td>
                    <td class="px-5 py-3 font-semibold text-cyan-600">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td class="px-5 py-3">
                        @php $colors = ['processing'=>'bg-blue-100 text-blue-600','buying'=>'bg-violet-100 text-violet-600','packing'=>'bg-amber-100 text-amber-600','shipping'=>'bg-cyan-100 text-cyan-600','delivered'=>'bg-emerald-100 text-emerald-600','cancelled'=>'bg-red-100 text-red-600']; @endphp
                        <span class="text-xs font-bold px-2 py-1 rounded-full {{ $colors[$order->status] ?? '' }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td class="px-5 py-3 text-xs text-slate-400 font-mono">{{ $order->resi ?: '—' }}</td>
                    <td class="px-5 py-3 text-slate-400">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td class="px-5 py-3">
                        <a href="/admin/orders/{{ $order->id }}" class="text-cyan-600 text-xs font-medium hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-5 py-8 text-center text-slate-400">Tidak ada pesanan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="px-5 py-3 border-t border-white/30">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
