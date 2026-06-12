<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Titipin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #e0f7fa 0%, #f3e5f5 25%, #fff3e0 50%, #e8f5e9 75%, #e3f2fd 100%); background-attachment: fixed; font-family: 'Inter', sans-serif; }
        .glass-strong { background: rgba(255,255,255,0.85); backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.6); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
        <div class="text-center mb-8">
            <span class="text-3xl font-black bg-gradient-to-r from-cyan-600 to-teal-500 bg-clip-text text-transparent">titipin</span>
            <p class="text-slate-500 text-sm mt-1">Admin Panel</p>
        </div>
        <div class="glass-strong rounded-3xl p-8 shadow-sm">
            @if($errors->any())
                <div class="bg-red-50 text-red-600 text-sm p-3 rounded-xl mb-4">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="/admin/login" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Email atau No. HP</label>
                    <input type="text" name="identifier" value="{{ old('identifier') }}" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">PIN</label>
                    <input type="password" name="pin" maxlength="6" inputmode="numeric" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm tracking-[0.5em] text-center text-lg focus:outline-none focus:ring-2 focus:ring-cyan-500/20 focus:border-cyan-500" required>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold py-3.5 rounded-xl shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 transition-all">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>
