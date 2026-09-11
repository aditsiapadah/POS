@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-200 dark:border-slate-700 p-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-[#0A2540] dark:text-white">
                Tambah Produk
            </h1>
        </div>
    </div>

    <form action="{{ route('produk.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- ========================= --}}
            {{-- KOLOM KIRI --}}
            {{-- ========================= --}}

            <div class="space-y-6">

                {{-- Nama Produk --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama produk"
                        required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                    @error('nama')
                    <p class="text-sm text-red-500 mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                {{-- Jenis Produk --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Jenis Produk
                    </label>

                    <select
                        name="jenis_produk_id"
                        required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                        <option value=""></option>

                        @foreach($jenisProduks as $jenis)
                        <option value="{{ $jenis->id }}"
                            {{ old('jenis_produk_id') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama }}
                        </option>
                        @endforeach

                    </select>

                    @error('jenis_produk_id')
                    <p class="text-sm text-red-500 mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                {{-- FOTO PRODUK --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Foto Produk
                    </label>

                    <div class="flex flex-col items-center">

                        <div
                            class="w-64 h-64 rounded-2xl border-2 border-dashed border-slate-300 dark:border-slate-600 bg-slate-100 dark:bg-slate-700 overflow-hidden shadow-md flex items-center justify-center">

                            <img
                                id="preview-image"
                                src="{{ asset('images/no-image.png') }}"
                                alt="Preview Produk"
                                class="w-full h-full object-cover">

                        </div>

                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept="image/*"
                            class="mt-5 block w-full text-sm text-slate-700 dark:text-slate-300
                            file:mr-4
                            file:px-5
                            file:py-3
                            file:rounded-xl
                            file:border-0
                            file:bg-[#0A2540]
                            file:text-white
                            hover:file:bg-[#12395f]
                            cursor-pointer">

                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                            JPG, JPEG, PNG, WEBP (Maks. 2 MB)
                        </p>

                        @error('foto')
                        <p class="text-sm text-red-500 mt-2">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                </div>

            </div>

            {{-- ========================= --}}
            {{-- KOLOM KANAN --}}
            {{-- ========================= --}}

            <div class="space-y-6">

                {{-- Harga Pokok --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Harga Pokok (Rp)
                    </label>

                    <input
                        type="number"
                        name="harga_beli"
                        value="{{ old('harga_beli') }}"
                        placeholder="Contoh : 3000"
                        required
                        min="0"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                    @error('harga_beli')
                    <p class="text-sm text-red-500 mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                {{-- Harga Jual --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Harga Jual (Rp)
                    </label>

                    <input
                        type="number"
                        name="harga_jual"
                        value="{{ old('harga_jual') }}"
                        placeholder="Contoh : 3500"
                        required
                        min="0"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                    @error('harga_jual')
                    <p class="text-sm text-red-500 mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                {{-- Stok --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok') }}"
                        placeholder="Contoh : 100"
                        required
                        min="0"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 px-4 py-3 text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-[#0A2540]/20 focus:border-[#0A2540]">

                    @error('stok')
                    <p class="text-sm text-red-500 mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="flex items-center gap-3 mt-8 border-t border-slate-200 dark:border-slate-700 pt-6">

            <a href="{{ route('produk.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl font-medium transition duration-200">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Kembali
            </a>

            <button
                type="submit"
                class="bg-[#0A2540] hover:bg-[#12395f] text-white px-5 py-3 rounded-xl font-medium transition duration-200">
                <i class="fa-solid fa-save mr-2"></i>
                Simpan
            </button>

        </div>

    </form>

</div>

{{-- Preview Foto --}}
<script>
    const foto = document.getElementById('foto');
    const preview = document.getElementById('preview-image');

    foto.addEventListener('change', function(e) {

        const file = e.target.files[0];

        if (!file) {
            preview.src = "{{ asset('images/no-image.png') }}";
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('File yang dipilih harus berupa gambar.');
            foto.value = '';
            preview.src = "{{ asset('images/no-image.png') }}";
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            preview.src = event.target.result;
        };

        reader.readAsDataURL(file);

    });
</script>

@endsection
