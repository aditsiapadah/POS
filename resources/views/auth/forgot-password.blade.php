<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - MitraMart POS</title>
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
                <h1 class="text-2xl font-bold text-white">Lupa Password?</h1>
                <p class="text-white/60 text-sm mt-2">Masukkan email akun kamu, kami akan buatkan link reset.</p>
            </div>

            @if(session('error'))
                <div class="mb-5 p-3 rounded-xl bg-red-500/20 border border-red-400/40 text-red-200 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-5 p-3 rounded-xl bg-emerald-500/20 border border-emerald-400/40 text-emerald-200 text-sm">
                    {!! session('success') !!}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-white/90 mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-white/40 text-sm"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full pl-11 pr-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder:text-white/40 outline-none focus:ring-2 focus:ring-blue-500/50"
                               placeholder="email@contoh.com">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl text-white font-semibold bg-gradient-to-r from-[#0A2540] to-[#1E3A8A] hover:opacity-90 transition">
                    Kirim Link Reset
                </button>
            </form>

            <p class="text-center text-white/50 text-sm mt-6">
                <a href="{{ route('login') }}" class="text-sky-300 hover:text-sky-200">← Kembali ke Login</a>
            </p>
        </div>
    </div>
</body>
</html>
