@extends('layouts.app')

@section('title', 'Tambah Jenis Produk')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-[#0A2540] dark:text-white">
        Tambah Jenis Produk
    </h1>
    <p class="text-gray-500 dark:text-gray-400 mt-2">
        Tambahkan jenis produk baru.
    </p>
</div>

<div class="bg-white dark:bg-slate-800 rounded-xl shadow p-8">
    <form action="{{ route('jenis-produk.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-6">

            {{-- Nama Jenis --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Nama Jenis Produk
                </label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Contoh: Makanan, Minuman, Elektronik"
                    class="w-full px-4 py-3 rounded-lg border
                    dark:bg-slate-700
                    dark:border-slate-600
                    dark:text-white
                    focus:ring-2 focus:ring-blue-500">
                @error('nama')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>

        </div>

        <div class="flex justify-end gap-3 mt-8">
            <a href="{{ route('jenis-produk.index') }}"
                class="px-5 py-3 rounded-lg bg-gray-500 text-white hover:bg-gray-600 transition">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
            <button
                type="submit"
                class="px-5 py-3 rounded-lg bg-[#1E3A8A]
                text-white hover:bg-blue-800 transition">
                <i class="fa-solid fa-save"></i>
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection
