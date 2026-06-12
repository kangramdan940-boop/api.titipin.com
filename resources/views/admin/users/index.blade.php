@extends('admin.layouts.app')
@section('title', 'Users')
@section('header', 'Daftar Users')

@section('content')
<div class="glass rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">User</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Phone</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Email</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Orders</th>
                    <th class="px-5 py-3 text-left text-xs font-semibold text-slate-500">Bergabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-white/30 transition">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-full flex items-center justify-center text-white text-xs font-bold">{{ substr($user->name, 0, 1) }}</div>
                            <span class="font-medium">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-slate-500">{{ $user->phone ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $user->email ?? '-' }}</td>
                    <td class="px-5 py-3">{{ $user->orders_count }}</td>
                    <td class="px-5 py-3 text-slate-400">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="px-5 py-3 border-t border-white/30">{{ $users->links() }}</div>
    @endif
</div>
@endsection
