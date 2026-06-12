<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Titipin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: '#0891B2' }, fontFamily: { sans: ['Inter', 'sans-serif'] } } } }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #e0f7fa 0%, #f3e5f5 25%, #fff3e0 50%, #e8f5e9 75%, #e3f2fd 100%); background-attachment: fixed; }
        .glass { background: rgba(255,255,255,0.6); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.5); }
        .glass-strong { background: rgba(255,255,255,0.85); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.6); }
    </style>
</head>
<body class="font-sans text-slate-800 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="hidden lg:flex w-64 flex-col fixed h-full glass-strong z-40 shadow-sm">
            <div class="p-6 border-b border-white/30">
                <a href="/admin/dashboard" class="text-xl font-black bg-gradient-to-r from-cyan-600 to-teal-500 bg-clip-text text-transparent">titipin</a>
                <p class="text-xs text-slate-400 mt-0.5">Admin Panel</p>
            </div>
            <nav class="flex-1 p-4 space-y-1">
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->is('admin/dashboard') ? 'bg-gradient-to-r from-cyan-500 to-teal-500 text-white shadow-md' : 'text-slate-600 hover:bg-white/50' }}">
                    <span>📊</span> Dashboard
                </a>
                <a href="/admin/orders" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->is('admin/orders*') ? 'bg-gradient-to-r from-cyan-500 to-teal-500 text-white shadow-md' : 'text-slate-600 hover:bg-white/50' }}">
                    <span>📦</span> Pesanan
                </a>
                <a href="/admin/products" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->is('admin/products*') ? 'bg-gradient-to-r from-cyan-500 to-teal-500 text-white shadow-md' : 'text-slate-600 hover:bg-white/50' }}">
                    <span>🛍️</span> Produk
                </a>
                <a href="/admin/users" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium {{ request()->is('admin/users*') ? 'bg-gradient-to-r from-cyan-500 to-teal-500 text-white shadow-md' : 'text-slate-600 hover:bg-white/50' }}">
                    <span>👥</span> Users
                </a>
            </nav>
            <div class="p-4 border-t border-white/30">
                <form action="/admin/logout" method="POST">
                    @csrf
                    <button class="w-full text-sm text-red-500 hover:bg-red-50 py-2 rounded-lg transition">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-1 lg:ml-64">
            <!-- Top bar -->
            <header class="sticky top-0 z-30 glass-strong shadow-sm px-6 py-4 flex items-center justify-between">
                <button id="mobile-menu-btn" class="lg:hidden p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-lg font-bold">@yield('header', 'Dashboard')</h1>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-500">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-full flex items-center justify-center text-white text-xs font-bold">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile sidebar overlay -->
    <div id="mobile-sidebar" class="fixed inset-0 z-50 hidden lg:hidden">
        <div class="absolute inset-0 bg-black/30" onclick="document.getElementById('mobile-sidebar').classList.add('hidden')"></div>
        <aside class="absolute left-0 top-0 h-full w-64 glass-strong shadow-xl p-4">
            <div class="mb-6 px-2">
                <span class="text-xl font-black bg-gradient-to-r from-cyan-600 to-teal-500 bg-clip-text text-transparent">titipin</span>
            </div>
            <nav class="space-y-1">
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-white/50"><span>📊</span> Dashboard</a>
                <a href="/admin/orders" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-white/50"><span>📦</span> Pesanan</a>
                <a href="/admin/products" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-white/50"><span>🛍️</span> Produk</a>
                <a href="/admin/users" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-white/50"><span>👥</span> Users</a>
            </nav>
        </aside>
    </div>

    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
            document.getElementById('mobile-sidebar').classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
