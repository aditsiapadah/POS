@extends('layouts.app')

@section('title', 'Edit Pengaturan')

@section('content')

<div class="space-y-6">

{{-- =========================================================
     HEADER
========================================================== --}}
<div class="relative overflow-hidden rounded-3xl
    bg-gradient-to-br from-[#0A2540] via-[#12395f] to-[#2563eb]
    px-6 py-7 md:px-8 md:py-8 shadow-xl">

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

                    <i class="fa-solid fa-pen-to-square"></i>

                </div>

                <span class="text-blue-100 text-xs
                    font-semibold uppercase tracking-widest">

                    Configuration

                </span>

            </div>

            <h1 class="text-3xl font-bold text-white">
                Edit Informasi/Tentang Aplikasi
            </h1>

            <p class="text-blue-100 text-sm mt-1">
                Perbarui informasi toko dan aplikasi MitraMart POS.
            </p>

        </div>


        <a href="{{ route('pengaturan.index') }}"
            class="inline-flex items-center justify-center gap-2
            bg-white/15 hover:bg-white/25
            backdrop-blur-md
            border border-white/20
            text-white
            px-5 py-3 rounded-xl
            font-semibold
            transition-all duration-200
            self-start sm:self-auto">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali

        </a>

    </div>

</div>


{{-- =========================================================
     ERROR
========================================================== --}}
@if($errors->any())

    <div class="rounded-2xl
        bg-red-50 dark:bg-red-900/20
        border border-red-200 dark:border-red-800
        p-5">

        <div class="flex items-start gap-4">

            <div class="w-10 h-10 rounded-xl
                bg-red-100 dark:bg-red-900/40
                text-red-500
                flex items-center justify-center
                flex-shrink-0">

                <i class="fa-solid fa-circle-exclamation"></i>

            </div>

            <div>

                <h3 class="font-bold text-red-700
                    dark:text-red-300 mb-2">

                    Terdapat kesalahan

                </h3>

                <ul class="list-disc pl-5
                    text-sm text-red-600
                    dark:text-red-300 space-y-1">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endif


{{-- =========================================================
     FORM
========================================================== --}}
<form action="{{ route('pengaturan.update') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6">

    @csrf
    @method('PUT')


    {{-- =====================================================
         INFORMASI TOKO
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

                        Data identitas dan kontak toko

                    </p>

                </div>

            </div>

        </div>


        {{-- Content --}}
        <div class="p-6 md:p-8 space-y-6">


            {{-- Nama Toko --}}
            <div>

                <label class="flex items-center gap-2
                    text-sm font-bold
                    text-gray-700 dark:text-gray-300 mb-2">

                    <i class="fa-solid fa-shop
                        text-[#0A2540] dark:text-blue-400"></i>

                    Nama Toko

                </label>

                <input
                    type="text"
                    name="nama_toko"
                    value="{{ old('nama_toko', $setting->nama_toko) }}"
                    placeholder="Masukkan nama toko"
                    required
                    class="w-full rounded-xl
                    border border-gray-200
                    dark:border-slate-600
                    bg-gray-50 dark:bg-slate-700/70
                    text-gray-900 dark:text-white
                    px-4 py-3.5
                    outline-none
                    focus:bg-white dark:focus:bg-slate-700
                    focus:border-blue-500
                    focus:ring-4 focus:ring-blue-500/10
                    transition">

            </div>


            {{-- Alamat --}}
            <div>

                <label class="flex items-center gap-2
                    text-sm font-bold
                    text-gray-700 dark:text-gray-300 mb-2">

                    <i class="fa-solid fa-location-dot
                        text-orange-500"></i>

                    Alamat

                </label>

                <textarea
                    name="alamat"
                    rows="3"
                    placeholder="Masukkan alamat toko"
                    class="w-full rounded-xl
                    border border-gray-200
                    dark:border-slate-600
                    bg-gray-50 dark:bg-slate-700/70
                    text-gray-900 dark:text-white
                    px-4 py-3.5
                    outline-none resize-none
                    focus:bg-white dark:focus:bg-slate-700
                    focus:border-blue-500
                    focus:ring-4 focus:ring-blue-500/10
                    transition">{{ old('alamat', $setting->alamat) }}</textarea>

            </div>


            {{-- Telepon + Email --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- Telepon --}}
                <div>

                    <label class="flex items-center gap-2
                        text-sm font-bold
                        text-gray-700 dark:text-gray-300 mb-2">

                        <i class="fa-brands fa-whatsapp
                            text-green-500"></i>

                        Telepon / WhatsApp

                    </label>

                    <input
                        type="text"
                        name="telepon"
                        value="{{ old('telepon', $setting->telepon) }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full rounded-xl
                        border border-gray-200
                        dark:border-slate-600
                        bg-gray-50 dark:bg-slate-700/70
                        text-gray-900 dark:text-white
                        px-4 py-3.5
                        outline-none
                        focus:bg-white dark:focus:bg-slate-700
                        focus:border-green-500
                        focus:ring-4 focus:ring-green-500/10
                        transition">

                </div>


                {{-- Email --}}
                <div>

                    <label class="flex items-center gap-2
                        text-sm font-bold
                        text-gray-700 dark:text-gray-300 mb-2">

                        <i class="fa-solid fa-envelope
                            text-blue-500"></i>

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $setting->email) }}"
                        placeholder="toko@email.com"
                        class="w-full rounded-xl
                        border border-gray-200
                        dark:border-slate-600
                        bg-gray-50 dark:bg-slate-700/70
                        text-gray-900 dark:text-white
                        px-4 py-3.5
                        outline-none
                        focus:bg-white dark:focus:bg-slate-700
                        focus:border-blue-500
                        focus:ring-4 focus:ring-blue-500/10
                        transition">

                </div>

            </div>

            {{-- =================================================
     INFORMASI PENGELOLA
================================================== --}}
<div>

    <label class="flex items-center gap-2
        text-sm font-bold
        text-gray-700 dark:text-gray-300 mb-2">

        <i class="fa-solid fa-user-tie
            text-blue-500"></i>

        Pengelola

    </label>


    <input
        type="text"
        name="pengelola"
        value="{{ old('pengelola', $setting->pengelola ?? '') }}"
        placeholder="Masukkan nama pengelola"

        class="w-full rounded-xl
        border border-gray-200
        dark:border-slate-600
        bg-gray-50 dark:bg-slate-700/70
        text-gray-900 dark:text-white
        px-4 py-3.5
        outline-none
        focus:bg-white dark:focus:bg-slate-700
        focus:border-blue-500
        focus:ring-4 focus:ring-blue-500/10
        transition">

</div>


            {{-- =================================================
                 LOGO
            ================================================== --}}
            <div>

                <label class="flex items-center gap-2
                    text-sm font-bold
                    text-gray-700 dark:text-gray-300 mb-3">

                    <i class="fa-solid fa-image
                        text-blue-500"></i>

                    Logo Toko

                </label>


                <div class="rounded-2xl
                    border border-dashed
                    border-gray-300 dark:border-slate-600
                    bg-gray-50 dark:bg-slate-700/30
                    p-5">

                    <div class="flex flex-col sm:flex-row
                        items-center sm:items-start gap-5">


                        {{-- Preview Logo --}}
                        <div class="flex-shrink-0">

                            @if($setting->logo)

                                <img
                                    src="{{ asset('storage/' . $setting->logo) }}"
                                    alt="Logo Toko"
                                    class="w-28 h-28 rounded-2xl
                                    object-cover
                                    border-4 border-white
                                    dark:border-slate-600
                                    shadow-lg">

                            @else

                                <div class="w-28 h-28 rounded-2xl
                                    bg-gradient-to-br
                                    from-[#0A2540] to-[#2563eb]
                                    flex items-center justify-center
                                    text-white text-4xl font-bold
                                    shadow-lg">

                                    {{ strtoupper(substr($setting->nama_toko ?? 'P', 0, 1)) }}

                                </div>

                            @endif

                        </div>


                        {{-- Upload --}}
                        <div class="flex-1 w-full">

                            <input
                                type="file"
                                name="logo"
                                accept="image/*"
                                class="w-full rounded-xl
                                border border-gray-200
                                dark:border-slate-600
                                bg-white dark:bg-slate-700
                                text-gray-700 dark:text-gray-200
                                p-2
                                file:mr-4
                                file:py-2
                                file:px-4
                                file:rounded-lg
                                file:border-0
                                file:font-semibold
                                file:bg-[#0A2540]
                                file:text-white
                                hover:file:bg-[#12395f]
                                cursor-pointer transition">

                            <p class="text-xs text-gray-500
                                dark:text-gray-400 mt-2">

                                <i class="fa-solid fa-circle-info mr-1"></i>

                                Format JPG, PNG, WEBP — maksimal 2MB.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         TENTANG APLIKASI
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

                        Informasi versi dan pengembang

                    </p>

                </div>

            </div>

        </div>


        {{-- Content --}}
        <div class="p-6 md:p-8 space-y-6">


            {{-- Nama Aplikasi + Versi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- Nama Aplikasi --}}
                <div>

                    <label class="flex items-center gap-2
                        text-sm font-bold
                        text-gray-700 dark:text-gray-300 mb-2">

                        <i class="fa-solid fa-cash-register
                            text-blue-500"></i>

                        Nama Aplikasi

                    </label>

                    <input
                        type="text"
                        name="nama_aplikasi"
                        value="{{ old('nama_aplikasi', $setting->nama_aplikasi ?? 'MitraMart POS') }}"
                        placeholder="Nama aplikasi"
                        class="w-full rounded-xl
                        border border-gray-200
                        dark:border-slate-600
                        bg-gray-50 dark:bg-slate-700/70
                        text-gray-900 dark:text-white
                        px-4 py-3.5
                        outline-none
                        focus:bg-white dark:focus:bg-slate-700
                        focus:border-blue-500
                        focus:ring-4 focus:ring-blue-500/10
                        transition">

                </div>


                {{-- Versi --}}
                <div>

                    <label class="flex items-center gap-2
                        text-sm font-bold
                        text-gray-700 dark:text-gray-300 mb-2">

                        <i class="fa-solid fa-code-branch
                            text-blue-500"></i>

                        Versi Aplikasi

                    </label>

                    <input
                        type="text"
                        name="versi_aplikasi"
                        value="{{ old('versi_aplikasi', $setting->versi_aplikasi ?? '1.0.0') }}"
                        placeholder="1.0.0"
                        class="w-full rounded-xl
                        border border-gray-200
                        dark:border-slate-600
                        bg-gray-50 dark:bg-slate-700/70
                        text-gray-900 dark:text-white
                        px-4 py-3.5
                        outline-none
                        focus:bg-white dark:focus:bg-slate-700
                        focus:border-blue-500
                        focus:ring-4 focus:ring-blue-500/10
                        transition">

                </div>

            </div>


            {{-- Deskripsi --}}
            <div>

                <label class="flex items-center gap-2
                    text-sm font-bold
                    text-gray-700 dark:text-gray-300 mb-2">

                    <i class="fa-solid fa-align-left
                        text-blue-500"></i>

                    Deskripsi Aplikasi

                </label>

                <textarea
                    name="deskripsi_aplikasi"
                    rows="4"
                    placeholder="Masukkan deskripsi aplikasi"
                    class="w-full rounded-xl
                    border border-gray-200
                    dark:border-slate-600
                    bg-gray-50 dark:bg-slate-700/70
                    text-gray-900 dark:text-white
                    px-4 py-3.5
                    outline-none resize-none
                    focus:bg-white dark:focus:bg-slate-700
                    focus:border-blue-500
                    focus:ring-4 focus:ring-blue-500/10
                    transition">{{ old('deskripsi_aplikasi', $setting->deskripsi_aplikasi ?? 'Aplikasi kasir berbasis web untuk membantu pengelolaan transaksi, produk, stok, dan laporan penjualan.') }}</textarea>

            </div>


            {{-- Developer --}}
            <div>

                <label class="flex items-center gap-2
                    text-sm font-bold
                    text-gray-700 dark:text-gray-300 mb-2">

                    <i class="fa-solid fa-user-tie
                        text-blue-500"></i>

                    Developer

                </label>

                <input
                    type="text"
                    name="developer"
                    value="{{ old('developer', $setting->developer ?? 'Aditya Dwi Saputra') }}"
                    placeholder="Nama developer"
                    class="w-full rounded-xl
                    border border-gray-200
                    dark:border-slate-600
                    bg-gray-50 dark:bg-slate-700/70
                    text-gray-900 dark:text-white
                    px-4 py-3.5
                    outline-none
                    focus:bg-white dark:focus:bg-slate-700
                    focus:border-blue-500
                    focus:ring-4 focus:ring-blue-500/10
                    transition">

            </div>

        </div>

    </div>


    {{-- =====================================================
         BUTTON
    ====================================================== --}}
    <div class="flex flex-col-reverse sm:flex-row
        justify-end gap-3 pb-4">

        <a href="{{ route('pengaturan.index') }}"
            class="inline-flex items-center
            justify-center gap-2
            px-6 py-3.5 rounded-xl
            bg-gray-100 hover:bg-gray-200
            dark:bg-slate-700
            dark:hover:bg-slate-600
            text-gray-700 dark:text-gray-200
            font-semibold
            transition">

            <i class="fa-solid fa-xmark"></i>

            Batal

        </a>


        <button type="submit"
            class="inline-flex items-center
            justify-center gap-2
            px-7 py-3.5 rounded-xl
            bg-gradient-to-r
            from-[#0A2540] to-[#2563eb]
            hover:from-[#12395f]
            hover:to-[#1d4ed8]
            text-white
            font-bold
            shadow-lg shadow-blue-900/20
            hover:-translate-y-0.5
            transition-all duration-200">

            <i class="fa-solid fa-floppy-disk"></i>

            Simpan Perubahan

        </button>

    </div>

</form>

</div>

@endsection
