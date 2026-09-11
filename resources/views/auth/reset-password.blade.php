<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - MitraMart POS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#020617] via-[#0A2540] to-[#1E3A8A] p-4">

    <div class="w-full max-w-md">
        <div class="bg-[#0B1220]/80 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl">

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-white">Reset Password</h1>
                <p class="text-white/60 text-sm mt-2">Masukkan password baru untuk akun kamu.</p>
            </div>

            @if(session('error'))
                <div class="mb-5 p-3 rounded-xl bg-red-500/20 border border-red-400/40 text-red-200 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" required readonly
                           class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/5 text-white/70 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1.5">Password Baru</label>
                    <input type="password" name="password" required minlength="6"
                           class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder:text-white/40 outline-none"
                           placeholder="Minimal 6 karakter">
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required minlength="6"
                           class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder:text-white/40 outline-none"
                           placeholder="Ulangi password baru">
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl text-white font-semibold bg-gradient-to-r from-[#0A2540] to-[#1E3A8A] hover:opacity-90 transition">
                    Ubah Password
                </button>
            </form>

            <p class="text-center text-white/50 text-sm mt-6">
                <a href="{{ route('login') }}" class="text-sky-300 hover:text-sky-200">← Kembali ke Login</a>
            </p>
        </div>
    </div>
</body>
</html>
