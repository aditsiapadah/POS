@extends('layouts.app')

@section('title', 'Tentang Aplikasi')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HEADER
========================================================== --}}
    <div class="relative overflow-hidden rounded-3xl
    bg-gradient-to-br from-[#0A2540] via-[#12395f] to-[#2563eb]
    px-6 py-6 md:px-8 md:py-7 shadow-xl">

        {{-- Decorative --}}
        <div class="absolute -top-24 -right-20
        w-64 h-64 bg-white/10 rounded-full blur-2xl"></div>

        <div class="absolute right-8 top-5 opacity-10">
            <i class="fa-solid fa-gear text-[120px] text-white"></i>
        </div>

        <div class="relative flex flex-col sm:flex-row
        sm:items-center sm:justify-between gap-5">

            <div>

                <div class="flex items-center gap-3 mb-2">

                    <div class="w-10 h-10 rounded-xl
                    bg-white/15 backdrop-blur
                    border border-white/20
                    flex items-center justify-center
                    text-white">

                        <i class="fa-solid fa-sliders"></i>

                    </div>

                    <span class="text-blue-100 text-xs
                    font-semibold uppercase tracking-widest">

                        System Settings

                    </span>

                </div>

                <h1 class="text-3xl font-bold text-white">
                    Tentang Aplikasi
                </h1>

                <p class="text-blue-100 text-sm mt-1">
                    Kelola informasi toko dan aplikasi MitraMart POS.
                </p>

            </div>


            {{-- Tombol Edit --}}
            <a href="{{ route('pengaturan.edit') }}"
                class="inline-flex items-center justify-center gap-2
            bg-white text-[#0A2540]
            hover:bg-blue-50
            px-5 py-3 rounded-xl
            font-bold shadow-lg
            transition-all duration-200
            hover:-translate-y-0.5
            self-start sm:self-auto">

                <i class="fa-solid fa-pen-to-square"></i>

                Edit Tentang Aplikasi

            </a>

        </div>

    </div>


    {{-- =========================================================
     2 COLUMN CONTENT
========================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


        {{-- =====================================================
         KIRI - INFORMASI TOKO
    ====================================================== --}}
        <div class="bg-white dark:bg-slate-800
        rounded-3xl
        border border-gray-100 dark:border-slate-700
        shadow-sm overflow-hidden">


            {{-- Header --}}
            <div class="px-6 py-5
            bg-gradient-to-r
            from-blue-50 to-slate-50
            dark:from-blue-900/20
            dark:to-slate-900/20
            border-b border-gray-100
            dark:border-slate-700">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl
                    bg-gradient-to-br
                    from-[#0A2540] to-[#2563eb]
                    flex items-center justify-center
                    text-white shadow-md">

                        <i class="fa-solid fa-store"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold
                        text-gray-900 dark:text-white">

                            Informasi Toko

                        </h2>

                        <p class="text-xs text-gray-500
                        dark:text-gray-400">

                            Identitas dan kontak toko

                        </p>

                    </div>

                </div>

            </div>


            {{-- Content --}}
            <div class="p-6">

                {{-- Logo + Nama --}}
                <div class="flex items-center gap-5 mb-6">

                    {{-- Logo --}}
                    @if($setting->logo)

                    <img src="{{ asset('storage/' . $setting->logo) }}"
                        alt="Logo Toko"
                        class="w-24 h-24 rounded-2xl
                        object-cover
                        border-4 border-white
                        dark:border-slate-700
                        shadow-lg flex-shrink-0">

                    @else

                    <div class="w-24 h-24 rounded-2xl
                        bg-gradient-to-br
                        from-[#0A2540] to-[#2563eb]
                        flex items-center justify-center
                        text-white text-4xl font-bold
                        shadow-lg flex-shrink-0">

                        {{ strtoupper(substr($setting->nama_toko ?? 'P', 0, 1)) }}

                    </div>

                    @endif


                    {{-- Nama --}}
                    <div class="min-w-0">

                        <p class="text-xs uppercase
                        tracking-wider font-semibold
                        text-gray-400 dark:text-gray-500 mb-1">

                            Nama Toko

                        </p>

                        <h3 class="text-2xl font-bold
                        text-[#0A2540] dark:text-white
                        truncate">

                            {{ $setting->nama_toko ?? '-' }}

                        </h3>

                        <div class="flex items-center gap-2 mt-2">

                            <span class="w-2 h-2 rounded-full
                            bg-green-500"></span>

                            <span class="text-xs font-semibold
                            text-green-600 dark:text-green-400">

                                Toko Aktif

                            </span>

                        </div>

                    </div>

                </div>


                {{-- Detail --}}
                <div class="space-y-3">
                                  
                    {{-- Alamat --}}
                    <div class="flex items-center gap-3
                    p-3.5 rounded-xl
                    bg-gray-50 dark:bg-slate-700/40
                    border border-gray-100
                    dark:border-slate-700">

                        <div class="w-9 h-9 rounded-lg
                        bg-orange-100 dark:bg-orange-900/20
                        text-orange-500
                        flex items-center justify-center
                        flex-shrink-0">

                            <i class="fa-solid fa-location-dot text-sm"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="text-[10px] uppercase
                            font-bold tracking-wider
                            text-gray-400 dark:text-gray-500">

                                Alamat

                            </p>

                            <p class="text-sm font-medium
                            text-gray-800 dark:text-gray-200
                            truncate">

                                {{ $setting->alamat ?: '-' }}

                            </p>

                        </div>

                    </div>


                    {{-- Telepon --}}
                    <div class="flex items-center gap-3
                    p-3.5 rounded-xl
                    bg-gray-50 dark:bg-slate-700/40
                    border border-gray-100
                    dark:border-slate-700">

                        <div class="w-9 h-9 rounded-lg
                        bg-green-100 dark:bg-green-900/20
                        text-green-500
                        flex items-center justify-center
                        flex-shrink-0">

                            <i class="fa-brands fa-whatsapp text-sm"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="text-[10px] uppercase
                            font-bold tracking-wider
                            text-gray-400 dark:text-gray-500">

                                Telepon / WhatsApp

                            </p>

                            <p class="text-sm font-semibold
                            text-gray-800 dark:text-gray-200">

                                {{ $setting->telepon ?: '-' }}

                            </p>

                        </div>

                    </div>


                    {{-- Email --}}
                    <div class="flex items-center gap-3
                    p-3.5 rounded-xl
                    bg-gray-50 dark:bg-slate-700/40
                    border border-gray-100
                    dark:border-slate-700">

                        <div class="w-9 h-9 rounded-lg
                        bg-blue-100 dark:bg-blue-900/20
                        text-blue-500
                        flex items-center justify-center
                        flex-shrink-0">

                            <i class="fa-solid fa-envelope text-sm"></i>

                        </div>

                        <div class="min-w-0">

                            <p class="text-[10px] uppercase
                            font-bold tracking-wider
                            text-gray-400 dark:text-gray-500">

                                Email

                            </p>

                            <p class="text-sm font-semibold
                            text-gray-800 dark:text-gray-200
                            truncate">

                                {{ $setting->email ?: '-' }}

                            </p>

                        </div>

                    </div>

                   {{-- Pengelola --}}
                    <div class="flex items-center gap-3
                    p-3.5 rounded-xl
                    bg-gray-50 dark:bg-slate-700/40
                    border border-gray-100
                    dark:border-slate-700">

                        <div class="w-9 h-9 rounded-lg
                        bg-blue-100 dark:bg-blue-900/20
                        text-blue-500
                        flex items-center justify-center
                        flex-shrink-0">

                            <i class="fa-solid fa-user-tie text-sm"></i>

                        </div>


                        <div class="min-w-0">

                            <p class="text-[10px] uppercase
                            font-bold tracking-wider
                            text-gray-400 dark:text-gray-500">

                                Pengelola

                            </p>


                            <p class="text-sm font-semibold
                            text-gray-800 dark:text-gray-200">

                                {{ $setting->pengelola ?? 'Belum diatur' }}

                            </p>

                        </div>

                    </div>
                    {{-- Status --}}
                    <div class="flex items-center gap-3
                    p-3.5 rounded-xl
                    bg-gray-50 dark:bg-slate-700/40
                    border border-gray-100
                    dark:border-slate-700">

                        <div class="w-9 h-9 rounded-lg
                        bg-blue-100 dark:bg-blue-900/20
                        text-blue-500
                        flex items-center justify-center
                        flex-shrink-0">

                            <i class="fa-solid fa-shield-halved text-sm"></i>

                        </div>

                        <div>

                            <p class="text-[10px] uppercase
                            font-bold tracking-wider
                            text-gray-400 dark:text-gray-500">

                                Status Sistem

                            </p>

                            <div class="flex items-center gap-2">

                                <span class="w-2 h-2 rounded-full
                                bg-green-500"></span>

                                <p class="text-sm font-semibold
                                text-gray-800 dark:text-gray-200">

                                    Sistem Aktif

                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Database --}}
                    <div class="flex items-center gap-3
                    p-3.5 rounded-xl
                    bg-gray-50 dark:bg-slate-700/40
                    border border-gray-100
                    dark:border-slate-700">

                        <div class="w-9 h-9 rounded-lg
                        bg-green-100 dark:bg-green-900/20
                        text-green-500
                        flex items-center justify-center
                        flex-shrink-0">

                            <i class="fa-solid fa-database text-sm"></i>

                        </div>


                        <div>

                            <p class="text-[10px] uppercase
                            font-bold tracking-wider
                            text-gray-400 dark:text-gray-500">

                                Database Sistem

                            </p>


                            <div class="flex items-center gap-2">

                                <span class="w-2 h-2 rounded-full
                                bg-green-500"></span>


                                <p class="text-sm font-semibold
                                text-gray-800 dark:text-gray-200">

                                    MySQL Database Aktif

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
         KANAN - TENTANG APLIKASI
    ====================================================== --}}
        <div class="bg-white dark:bg-slate-800
        rounded-3xl
        border border-gray-100 dark:border-slate-700
        shadow-sm overflow-hidden">


            {{-- Header --}}
            <div class="px-6 py-5
            bg-gradient-to-r
            from-blue-50 to-slate-50
            dark:from-blue-900/20
            dark:to-slate-900/20
            border-b border-gray-100
            dark:border-slate-700">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl
                    bg-gradient-to-br
                    from-[#0A2540] to-[#2563eb]
                    flex items-center justify-center
                    text-white shadow-md">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold
                        text-gray-900 dark:text-white">

                            Tentang Aplikasi

                        </h2>

                        <p class="text-xs text-gray-500
                        dark:text-gray-400">

                            Informasi aplikasi dan pengembang

                        </p>

                    </div>

                </div>

            </div>


            {{-- Content --}}
            <div class="p-6">


                {{-- App Identity --}}
                <div class="flex items-center
                justify-between gap-4 mb-6">

                    <div class="flex items-center gap-4 min-w-0">

                        <div class="w-14 h-14 rounded-2xl
                        bg-gradient-to-br
                        from-[#0A2540] to-[#2563eb]
                        flex items-center justify-center
                        text-white text-xl shadow-lg
                        flex-shrink-0">

                            <i class="fa-solid fa-cash-register"></i>

                        </div>

                        <div class="min-w-0">

                            <h3 class="text-xl font-bold
                            text-[#0A2540] dark:text-white
                            truncate">

                                {{ $setting->nama_aplikasi ?? 'MitraMart POS' }}

                            </h3>

                            <p class="text-xs text-gray-500
                            dark:text-gray-400 mt-1">

                                Point of Sale Management System

                            </p>

                        </div>

                    </div>


                    {{-- Version --}}
                    <span class="flex-shrink-0
                    inline-flex items-center gap-1.5
                    px-3 py-1.5 rounded-lg
                    bg-blue-50 dark:bg-blue-900/20
                    text-blue-600 dark:text-blue-400
                    text-xs font-bold">

                        <i class="fa-solid fa-code-branch"></i>

                        v{{ $setting->versi_aplikasi ?? '1.0.0' }}

                    </span>

                </div>


                {{-- Description --}}
                <div class="p-4 rounded-2xl
                bg-gray-50 dark:bg-slate-700/40
                border border-gray-100
                dark:border-slate-700 mb-5">

                    <div class="flex gap-3">

                        <div class="w-9 h-9 rounded-lg
                        bg-blue-100 dark:bg-blue-900/20
                        text-blue-500
                        flex items-center justify-center
                        flex-shrink-0">

                            <i class="fa-solid fa-align-left text-sm"></i>

                        </div>

                        <div>

                            <p class="text-[10px] uppercase
                            font-bold tracking-wider
                            text-gray-400 dark:text-gray-500 mb-1">

                                Deskripsi

                            </p>

                            <p class="text-sm text-gray-700
                            dark:text-gray-300 leading-relaxed">

                                {{ $setting->deskripsi_aplikasi ??
                                'Aplikasi kasir berbasis web untuk membantu pengelolaan transaksi, produk, stok, dan laporan penjualan.' }}

                            </p>

                        </div>

                    </div>

                </div>


                {{-- Teknologi --}}
                <div class="mb-6">

                    <p class="text-xs uppercase
                    tracking-wider font-bold
                    text-gray-400 dark:text-gray-500 mb-3">

                        Teknologi

                    </p>

                    <div class="grid grid-cols-2 gap-2">


                        <div class="flex items-center gap-2
                        px-3 py-2.5 rounded-xl
                        bg-red-50 dark:bg-red-900/20
                        text-red-600 dark:text-red-400">

                            <i class="fa-brands fa-laravel"></i>

                            <span class="text-xs font-semibold">
                                Laravel 12
                            </span>

                        </div>


                        <div class="flex items-center gap-2
                        px-3 py-2.5 rounded-xl
                        bg-cyan-50 dark:bg-cyan-900/20
                        text-cyan-600 dark:text-cyan-400">

                            <i class="fa-solid fa-wind"></i>

                            <span class="text-xs font-semibold">
                                Tailwind CSS
                            </span>

                        </div>


                        <div class="flex items-center gap-2
                        px-3 py-2.5 rounded-xl
                        bg-blue-50 dark:bg-blue-900/20
                        text-blue-600 dark:text-blue-400">

                            <i class="fa-solid fa-database"></i>

                            <span class="text-xs font-semibold">
                                MySQL
                            </span>

                        </div>


                        <div class="flex items-center gap-2
                        px-3 py-2.5 rounded-xl
                        bg-slate-100 dark:bg-slate-700/50
                        text-slate-600 dark:text-slate-300">

                            <i class="fa-brands fa-bootstrap"></i>

                            <span class="text-xs font-semibold">
                                Bootstrap
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Hak Akses --}}
                <div class="mb-6">

                    <p class="text-xs uppercase
                    tracking-wider font-bold
                    text-gray-400 dark:text-gray-500 mb-3">

                        Hak Akses Pengguna

                    </p>


                    <div class="grid grid-cols-1 gap-3">


                        <div class="p-4 rounded-xl
                        bg-blue-50 dark:bg-blue-900/20">

                            <div class="flex items-center gap-2 mb-2">

                                <i class="fa-solid fa-user-shield text-blue-600"></i>

                                <h4 class="font-bold text-sm">
                                    Admin
                                </h4>

                            </div>


                            <p class="text-xs text-gray-600 dark:text-gray-300">
                                Admin memiliki akses penuh untuk mengelola aplikasi,
                                seperti mengelola user dan produk,
                                transaksi, laporan penjualan, dan pengaturan sistem.
                            </p>

                        </div>



                        <div class="p-4 rounded-xl
                        bg-green-50 dark:bg-green-900/20">

                            <div class="flex items-center gap-2 mb-2">

                                <i class="fa-solid fa-user text-green-600"></i>

                                <h4 class="font-bold text-sm">
                                    Kasir
                                </h4>

                            </div>


                            <p class="text-xs text-gray-600 dark:text-gray-300">
                                Kasir memiliki akses untuk melakukan transaksi penjualan,
                                melihat produk, mengelola proses pembayaran,
                                serta melihat laporan penjualan sesuai izin yang diberikan.
                            </p>

                        </div>


                    </div>

                </div>


                {{-- Developer --}}
                <div class="pt-5
                border-t border-gray-100
                dark:border-slate-700
                flex items-center
                justify-between gap-3">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-lg
                        bg-gray-100 dark:bg-slate-700
                        flex items-center justify-center
                        text-gray-500 dark:text-gray-300">

                            <i class="fa-solid fa-user-tie text-sm"></i>

                        </div>

                        <div>

                            <p class="text-[10px]
                            uppercase tracking-wider
                            font-bold text-gray-400">

                                Developer

                            </p>

                            <p class="text-sm font-bold
                            text-gray-800 dark:text-white">

                                {{ $setting->developer ?? 'Aditya Dwi Saputra' }}

                            </p>

                        </div>

                    </div>


                    <p class="text-xs text-gray-400
                    dark:text-gray-500">

                        © {{ date('Y') }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
