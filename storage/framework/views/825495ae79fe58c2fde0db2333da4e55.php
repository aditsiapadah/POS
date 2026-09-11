<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login MitraMart POS</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(10, 37, 64, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0A2540, #1E3A8A);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(30, 58, 138, 0.45);
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.45;
            animation: move 12s infinite alternate ease-in-out;
        }

        .blob-one {
            width: 380px;
            height: 380px;
            background: #2563eb;
            top: -140px;
            left: -120px;
        }

        .blob-two {
            width: 450px;
            height: 450px;
            background: #1e40af;
            right: -140px;
            bottom: -160px;
            animation-delay: 3s;
        }

        .blob-three {
            width: 280px;
            height: 280px;
            background: #38bdf8;
            top: 35%;
            left: 60%;
            animation-delay: 6s;
        }

        @keyframes move {
            0%   { transform: translate(0, 0) scale(1); }
            50%  { transform: translate(60px, -35px) scale(1.12); }
            100% { transform: translate(-40px, 40px) scale(0.92); }
        }

        .panel {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hidden-panel {
            opacity: 0;
            pointer-events: none;
            transform: translateX(20px);
            position: absolute;
            inset: 0;
        }

        .active-panel {
            opacity: 1;
            pointer-events: auto;
            transform: translateX(0);
            position: relative;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#020617] via-[#0A2540] to-[#1E3A8A] p-4 overflow-x-hidden overflow-y-auto relative">

    <!-- Background blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="blob blob-one"></div>
        <div class="blob blob-two"></div>
        <div class="blob blob-three"></div>
    </div>

    <!-- Main Card -->
    <div class="w-full max-w-5xl relative z-10">
        <div class="glass-card rounded-3xl overflow-hidden flex flex-col lg:flex-row shadow-2xl">

            <!-- LEFT SIDE (Branding) -->
            <div class="lg:w-5/12 bg-gradient-to-br from-[#0A2540] to-[#1E3A8A] p-6 sm:p-10 flex flex-col justify-between text-white relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute -bottom-20 -left-20 w-64 h-64 rounded-full border border-white/10"></div>
                <div class="absolute -top-16 -right-16 w-48 h-48 rounded-full border border-white/10"></div>

                <div>
                    <div class="flex items-center gap-3 mb-8">
                        <img src="<?php echo e(asset('images/logo-sekolah.png')); ?>"
                             class="w-14 h-14 rounded-full object-cover ring-2 ring-white/30 shadow-lg"
                             alt="Logo">
                        <div>
                            <h2 class="text-xl font-bold tracking-wide">MITRAMART POS</h2>
                            <p class="text-sm text-white/70">Sistem Kasir Digital</p>
                        </div>
                    </div>

                    <div id="left-login-content">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-xs font-medium mb-5">
                            <i class="fa-solid fa-circle-check text-emerald-300"></i>
                            WELCOME BACK
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-4">
                            Kembali ke<br>sistem kasir
                        </h1>
                        <p class="text-white/75 text-sm leading-relaxed">
                            Masuk untuk mengelola penjualan, stok, dan laporan toko dengan cepat dan aman.
                        </p>
                    </div>

                    <div id="left-register-content" class="hidden">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 text-xs font-medium mb-5">
                            <i class="fa-solid fa-user-plus text-sky-300"></i>
                            JOIN THE CREW
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-4">
                            Buat akun<br>operator baru
                        </h1>
                        <p class="text-white/75 text-sm leading-relaxed">
                            Daftarkan akun untuk mulai mengelola kasir, produk, dan transaksi toko.
                        </p>
                    </div>
                </div>

                <div class="mt-10 text-sm text-white/60 italic">
                    “Kerja cepat, data akurat, toko semakin maju.”
                </div>
            </div>

            <!-- RIGHT SIDE (Forms) -->
            <div class="lg:w-7/12 bg-[#0B1220]/80 p-6 sm:p-10 relative lg:min-h-[520px]">

                <!-- LOGIN PANEL -->
                <div id="login-panel" class="panel active-panel">
                    <h2 class="text-2xl font-bold text-white mb-1">Welcome back</h2>
                    <p class="text-white/60 text-sm mb-7">Masuk ke konsol kasir untuk mengelola penjualan</p>

                    <?php if(session('error')): ?>
                        <div class="mb-5 p-3 rounded-xl bg-red-500/20 border border-red-400/40 text-red-200 text-sm">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(session('success')): ?>
                        <div class="mb-5 p-3 rounded-xl bg-emerald-500/20 border border-emerald-400/40 text-emerald-200 text-sm">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('auth')); ?>" method="POST" class="space-y-5">
                        <?php echo csrf_field(); ?>

                        <div>
                            <label class="block text-sm font-medium text-white/90 mb-1.5">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-envelope text-white/40 text-sm"></i>
                                </div>
                                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                                       class="input-field w-full pl-11 pr-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder:text-white/40 outline-none transition"
                                       placeholder="email@contoh.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white/90 mb-1.5">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock text-white/40 text-sm"></i>
                                </div>
                                <input type="password" name="password" id="login-password" required
                                       class="input-field w-full pl-11 pr-12 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder:text-white/40 outline-none transition"
                                       placeholder="Masukkan password">
                                <button type="button" onclick="togglePassword('login-password', this)"
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-white/40 hover:text-white/70">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center gap-2 cursor-pointer text-white/70">
                                <input type="checkbox" name="remember" class="rounded border-white/30 bg-white/10 text-blue-500 focus:ring-0">
                                Remember me
                            </label>
                            <a href="<?php echo e(route('password.request')); ?>" class="text-sky-300 hover:text-sky-200 transition">
                                Lupa password?
                            </a>
                        </div>

                        <button type="submit" class="btn-primary w-full py-3.5 rounded-xl text-white font-semibold flex items-center justify-center gap-2">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span>Sign in</span>
                        </button>
                    </form>

                    <p class="text-center text-white/50 text-sm mt-7">
                        Belum punya akun?
                        <button type="button" onclick="showRegister()" class="text-sky-300 hover:text-sky-200 font-medium ml-1">
                            Create an account
                        </button>
                    </p>
                </div>

                <!-- REGISTER PANEL -->
                <div id="register-panel" class="panel hidden-panel">
                    <h2 class="text-2xl font-bold text-white mb-1">Join the crew</h2>
                    <p class="text-white/60 text-sm mb-7">Daftarkan akun operator untuk sistem kasir</p>

                    <form action="<?php echo e(route('register')); ?>" method="POST" class="space-y-4" id="register-form">
                        <?php echo csrf_field(); ?>

                        <div>
                            <label class="block text-sm font-medium text-white/90 mb-1.5">Nama Lengkap</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-user text-white/40 text-sm"></i>
                                </div>
                                <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                                       class="input-field w-full pl-11 pr-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder:text-white/40 outline-none transition"
                                       placeholder="Nama lengkap">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white/90 mb-1.5">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-envelope text-white/40 text-sm"></i>
                                </div>
                                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                                       class="input-field w-full pl-11 pr-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder:text-white/40 outline-none transition"
                                       placeholder="email@contoh.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white/90 mb-1.5">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock text-white/40 text-sm"></i>
                                </div>
                                <input type="password" name="password" id="reg-password" required minlength="6"
                                       class="input-field w-full pl-11 pr-12 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder:text-white/40 outline-none transition"
                                       placeholder="Minimal 6 karakter">
                                <button type="button" onclick="togglePassword('reg-password', this)"
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-white/40 hover:text-white/70">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white/90 mb-1.5">Konfirmasi Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-shield-halved text-white/40 text-sm"></i>
                                </div>
                                <input type="password" name="password_confirmation" id="reg-password-confirm" required minlength="6"
                                       class="input-field w-full pl-11 pr-12 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder:text-white/40 outline-none transition"
                                       placeholder="Ulangi password">
                                <button type="button" onclick="togglePassword('reg-password-confirm', this)"
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-white/40 hover:text-white/70">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary w-full py-3.5 rounded-xl text-white font-semibold flex items-center justify-center gap-2 mt-2">
                            <i class="fa-solid fa-user-plus"></i>
                            <span>Create account</span>
                        </button>
                    </form>

                    <p class="text-center text-white/50 text-sm mt-7">
                        Sudah punya akun?
                        <button type="button" onclick="showLogin()" class="text-sky-300 hover:text-sky-200 font-medium ml-1">
                            Sign in
                        </button>
                    </p>
                </div>
            </div>
        </div>

        <p class="text-center text-white/50 text-sm mt-6">
            © <?php echo e(date('Y')); ?> MitraMart POS — Sistem Kasir Digital
        </p>
    </div>

    <script>
        function showRegister() {
            document.getElementById('login-panel').classList.remove('active-panel');
            document.getElementById('login-panel').classList.add('hidden-panel');
            document.getElementById('register-panel').classList.remove('hidden-panel');
            document.getElementById('register-panel').classList.add('active-panel');

            document.getElementById('left-login-content').classList.add('hidden');
            document.getElementById('left-register-content').classList.remove('hidden');
        }

        function showLogin() {
            document.getElementById('register-panel').classList.remove('active-panel');
            document.getElementById('register-panel').classList.add('hidden-panel');
            document.getElementById('login-panel').classList.remove('hidden-panel');
            document.getElementById('login-panel').classList.add('active-panel');

            document.getElementById('left-register-content').classList.add('hidden');
            document.getElementById('left-login-content').classList.remove('hidden');
        }

        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Validasi password match di frontend
        document.getElementById('register-form')?.addEventListener('submit', function(e) {
            const pass = document.getElementById('reg-password').value;
            const confirm = document.getElementById('reg-password-confirm').value;
            if (pass !== confirm) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak sama!');
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\pos\resources\views/login.blade.php ENDPATH**/ ?>