@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="max-w-xl mx-auto bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 p-6">

    <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-6">
        Detail Produk
    </h2>


    <div class="space-y-5 text-sm">


        {{-- Nama Produk --}}
        <div>

            <span class="block text-xs font-semibold text-slate-400 uppercase">
                Nama Produk
            </span>

            <span class="text-slate-800 dark:text-white font-medium text-base">
                {{ $produk->nama }}
            </span>

        </div>

        {{-- Jenis Produk --}}
        <div>

            <span class="block text-xs font-semibold text-slate-400 uppercase">
                Jenis Produk
            </span>


            <span class="text-slate-800 dark:text-white font-medium text-base">
                {{ $produk->jenisProduk->nama ?? '-' }}
            </span>
        </div>




        {{-- Penginput --}}
        <div>

            <span class="block text-xs font-semibold text-slate-400 uppercase">
                Penginput (User)
            </span>

            <span class="text-slate-700 dark:text-slate-300">
                {{ $produk->user->name ?? '-' }}
            </span>

        </div>





        {{-- Foto --}}
        <div>

            <span class="block text-xs font-semibold text-slate-400 uppercase">
                Foto
            </span>


            @if($produk->foto)

                <img 
                    src="{{ asset('storage/'.$produk->foto) }}"
                    class="w-56 rounded-lg border mt-2 dark:border-slate-600">

            @else

                <span class="text-slate-400 italic">
                    Tidak ada foto
                </span>

            @endif


        </div>





        {{-- Harga --}}
        <div class="grid grid-cols-2 gap-4">


            <div>

                <span class="block text-xs font-semibold text-slate-400 uppercase">
                    Harga Pokok
                </span>


                <span class="text-slate-700 dark:text-slate-300 font-semibold">

                    Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}

                </span>

            </div>




            <div>

                <span class="block text-xs font-semibold text-slate-400 uppercase">
                    Harga Jual
                </span>


                <span class="text-slate-700 dark:text-slate-300 font-semibold">

                    Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}

                </span>

            </div>


        </div>





        {{-- Stok --}}
        <div>

            <span class="block text-xs font-semibold text-slate-400 uppercase">
                Stok Tersedia
            </span>


            <span class="text-slate-700 dark:text-slate-300 font-semibold">

                {{ $produk->stok }} Unit

            </span>

        </div>



    </div>





    {{-- Tombol Kembali --}}
    <div class="flex justify-end pt-6 mt-6 border-t border-slate-100 dark:border-slate-700">


        <a href="{{ route('produk.index') }}"
            class="
            bg-slate-100 dark:bg-slate-700
            text-slate-600 dark:text-slate-200
            px-4 py-2
            rounded-lg
            text-sm
            font-semibold
            hover:bg-slate-200
            dark:hover:bg-slate-600
            transition">

            Kembali

        </a>


    </div>


</div>

@endsection
