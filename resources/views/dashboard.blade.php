@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<x-page-header
    title="Ringkasan Hari Ini"
    subtitle="{{ $tanggalHariIni->translatedFormat('l, d F Y') }}"
    label="Dashboard Overview"
    icon="fa-chart-line"
/>
<br>
{{-- =========================================================
    KARTU STATISTIK
========================================================= --}}
@if(auth()->user()->role->name == 'Admin')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

    {{-- =====================================================
        TOTAL PENJUALAN
    ====================================================== --}}
    <div class="
    group
    bg-white dark:bg-[#162033]
    rounded-3xl p-6
    shadow-lg hover:shadow-xl
    border border-slate-100 dark:border-slate-700
    transition-all duration-500
    hover:-translate-y-2
    flex items-center justify-between
    ">

        <div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-semibold">
                Total Penjualan Hari Ini
            </p>

            <p class="text-2xl font-bold text-[#0A2540] dark:text-white mt-2">
                Rp {{ number_format($ringkasan->total_pendapatan ?? 0, 0, ',', '.') }}
            </p>
        </div>

        {{-- Icon Penjualan --}}
        <div class="
            relative
            w-16 h-16
            rounded-2xl
            bg-blue-50 dark:bg-blue-900/30
            flex items-center justify-center
            flex-shrink-0 ml-4
            group-hover:scale-105
            transition-transform duration-300
        ">

            <div class="
                absolute inset-2
                rounded-xl
                bg-blue-100 dark:bg-blue-800/40
            "></div>

            <svg
                class="relative w-8 h-8 text-blue-600 dark:text-blue-400"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M6 3H18L20 21H4L6 3Z"
                    fill="currentColor"
                    opacity="0.15"
                />

                <path
                    d="M6 3H18L20 21H4L6 3Z"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <path
                    d="M9 7C9 8.657 10.343 10 12 10C13.657 10 15 8.657 15 7"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />

                <path
                    d="M9 15H15"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />
            </svg>
        </div>
    </div>


    {{-- =====================================================
        JUMLAH TRANSAKSI
    ====================================================== --}}
    <div class="
    group
    bg-white dark:bg-[#162033]
    rounded-3xl p-6
    shadow-lg hover:shadow-xl
    border border-slate-100 dark:border-slate-700
    transition-all duration-500
    hover:-translate-y-2
    flex items-center justify-between
    ">

        <div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-semibold">
                Jumlah Transaksi
            </p>

            <p class="text-3xl font-bold text-[#0A2540] dark:text-white mt-2">
                {{ $ringkasan->total_transaksi ?? 0 }}
            </p>
        </div>

        {{-- Icon Transaksi --}}
        <div class="
            relative
            w-16 h-16
            rounded-2xl
            bg-emerald-50 dark:bg-emerald-900/30
            flex items-center justify-center
            flex-shrink-0 ml-4
            group-hover:scale-105
            transition-transform duration-300
        ">

            <div class="
                absolute inset-2
                rounded-xl
                bg-emerald-100 dark:bg-emerald-800/40
            "></div>

            <svg
                class="relative w-8 h-8 text-emerald-600 dark:text-emerald-400"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M7 3H17C18.1 3 19 3.9 19 5V21L16 19L13 21L10 19L7 21V5C7 3.9 7.9 3 9 3"
                    fill="currentColor"
                    opacity="0.15"
                />

                <path
                    d="M7 3H17C18.1 3 19 3.9 19 5V21L16 19L13 21L10 19L7 21V5C7 3.9 7.9 3 9 3"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

                <path
                    d="M10 8H16"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />

                <path
                    d="M10 12H16"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />

                <path
                    d="M10 16H13"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />
            </svg>
        </div>
    </div>


    {{-- =====================================================
        PEMBAYARAN TUNAI
    ====================================================== --}}
   <div class="
    group
    bg-white dark:bg-[#162033]
    rounded-3xl p-6
    shadow-lg hover:shadow-xl
    border border-slate-100 dark:border-slate-700
    transition-all duration-500
    hover:-translate-y-2
    flex items-center justify-between
    ">

        <div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-semibold">
                Total Pembayaran Tunai
            </p>

            <p class="text-2xl font-bold text-[#0A2540] dark:text-white mt-2">
                Rp {{ number_format($ringkasan->total_cash ?? 0, 0, ',', '.') }}
            </p>
        </div>

        {{-- Icon Wallet --}}
        <div class="
            relative
            w-16 h-16
            rounded-2xl
            bg-amber-50 dark:bg-amber-900/30
            flex items-center justify-center
            flex-shrink-0 ml-4
            group-hover:scale-105
            transition-transform duration-300
        ">

            <div class="
                absolute inset-2
                rounded-xl
                bg-amber-100 dark:bg-amber-800/40
            "></div>

            <svg
                class="relative w-8 h-8 text-amber-600 dark:text-amber-400"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M4 6.5C4 5.4 4.9 4.5 6 4.5H19C19.55 4.5 20 4.95 20 5.5V8H7C5.34 8 4 9.34 4 11V6.5Z"
                    fill="currentColor"
                    opacity="0.15"
                />

                <path
                    d="M4 8V6.5C4 5.4 4.9 4.5 6 4.5H19"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />

                <path
                    d="M7 8H20V18.5C20 19.05 19.55 19.5 19 19.5H6C4.9 19.5 4 18.6 4 17.5V11C4 9.34 5.34 8 7 8Z"
                    fill="currentColor"
                    opacity="0.15"
                />

                <path
                    d="M7 8H20V18.5C20 19.05 19.55 19.5 19 19.5H6C4.9 19.5 4 18.6 4 17.5V11C4 9.34 5.34 8 7 8Z"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linejoin="round"
                />

                <path
                    d="M15 14H17"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                />
            </svg>
        </div>
    </div>


    {{-- =====================================================
        PEMBAYARAN NON-TUNAI
    ====================================================== --}}
    <div class="
    group
    bg-white dark:bg-[#162033]
    rounded-3xl p-6
    shadow-lg hover:shadow-xl
    border border-slate-100 dark:border-slate-700
    transition-all duration-500
    hover:-translate-y-2
    flex items-center justify-between
    ">

        <div>
            <p class="text-slate-500 dark:text-slate-400 text-xs font-semibold">
                Total Pembayaran Non-Tunai
            </p>

            <p class="text-2xl font-bold text-[#0A2540] dark:text-white mt-2">
                Rp {{ number_format($ringkasan->total_non_tunai ?? 0, 0, ',', '.') }}
            </p>
        </div>

        {{-- Icon Credit Card --}}
        <div class="
            relative
            w-16 h-16
            rounded-2xl
            bg-indigo-50 dark:bg-indigo-900/30
            flex items-center justify-center
            flex-shrink-0 ml-4
            group-hover:scale-105
            transition-transform duration-300
        ">

            <div class="
                absolute inset-2
                rounded-xl
                bg-indigo-100 dark:bg-indigo-800/40
            "></div>

            <svg
                class="relative w-8 h-8 text-indigo-600 dark:text-indigo-400"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <rect
                    x="3"
                    y="5"
                    width="18"
                    height="14"
                    rx="2.5"
                    fill="currentColor"
                    opacity="0.15"
                />

                <rect
                    x="3"
                    y="5"
                    width="18"
                    height="14"
                    rx="2.5"
                    stroke="currentColor"
                    stroke-width="1.8"
                />

                <path
                    d="M3 10H21"
                    stroke="currentColor"
                    stroke-width="1.8"
                />

                <path
                    d="M7 15H10"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />

                <path
                    d="M14 15H17"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />
            </svg>
        </div>
    </div>

</div>

@endif

{{-- Critical Inventory --}}

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">


    {{-- STOK RENDAH --}}
        <div class="
        bg-white dark:bg-[#162033]
        rounded-3xl
        shadow-xl
        p-4 sm:p-8
        transition-all
        duration-300
        hover:-translate-y-2
        hover:shadow-2xl
    ">


        <h3 class="
            text-lg sm:text-xl font-semibold
            text-[#0A2540] dark:text-white
            mb-6
            flex items-center gap-3
        ">

            <span class="text-orange-500">
                ⚠️
            </span>

            Daftar Produk Stok Rendah

        </h3>



        <div class="
            overflow-x-auto
            border border-slate-100 dark:border-slate-700
            rounded-2xl
        ">


            <table class="w-full min-w-[500px]">


                <thead>

                    <tr class="
                        border-b
                        border-slate-200
                        dark:border-slate-700
                    ">


                        <th class="
                            text-left
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            #
                        </th>


                        <th class="
                            text-left
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            Nama Produk
                        </th>


                        <th class="
                            text-center
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            Stok
                        </th>


                    </tr>

                </thead>



                <tbody class="
                    text-slate-700
                    dark:text-slate-200

                    divide-y
                    divide-slate-200
                    dark:divide-slate-700
                ">


                    @forelse($produkStokRendah as $index => $produk)


                    <tr>


                        <td class="py-4 px-6">

                            {{ $produkStokRendah->firstItem() + $index }}

                        </td>


                        <td class="py-4 px-6">

                            {{ $produk->nama }}

                        </td>


                        <td class="
                            text-center
                            py-4 px-6
                            font-semibold
                            text-orange-600
                        ">

                            {{ $produk->stok }}

                        </td>


                    </tr>


                    @empty


                    <tr>

                        <td colspan="3"
                            class="
                            text-center
                            py-8
                            text-slate-400
                            dark:text-slate-500
                        ">

                            Tidak ada produk stok rendah

                        </td>

                    </tr>


                    @endforelse


                </tbody>


            </table>


        </div>



        @if($produkStokRendah->hasPages())


        <div class="
            flex
            justify-between
            items-center
            mt-6
        ">


            <div class="
                text-sm
                text-slate-500
                dark:text-slate-400
            ">
                Menampilkan
                {{ $produkStokRendah->firstItem() }}
                -
                {{ $produkStokRendah->lastItem() }}
                dari
                {{ $produkStokRendah->total() }}
                produk
            </div>
            <div>
                {{ $produkStokRendah->links('pagination::tailwind') }}
            </div>
        </div>
        @endif
    </div>
    {{-- STOK HABIS --}}
    <div class="
        bg-white dark:bg-[#162033]
        rounded-3xl
        shadow-xl
        p-4 sm:p-8
        transition-all
        duration-300
        hover:-translate-y-2
        hover:shadow-2xl
    ">
        <h3 class="
            text-lg sm:text-xl font-semibold
            text-[#0A2540] dark:text-white
            mb-6
            flex items-center gap-3
        ">
            <span class="text-red-500">
                ⛔
            </span>
            Daftar Produk Habis
        </h3>
        <div class="
            overflow-x-auto
            border border-slate-100 dark:border-slate-700
            rounded-2xl
        ">
            <table class="w-full min-w-[500px]">
                <thead>
                    <tr class="
                        border-b
                        border-slate-200
                        dark:border-slate-700
                    ">
                        <th class="
                            text-left
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            #
                        </th>
                        <th class="
                            text-left
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            Nama Produk
                        </th>
                        <th class="
                            text-center
                            py-4 px-6
                            text-slate-500
                            dark:text-slate-400
                            font-medium
                        ">
                            Stok
                        </th>
                    </tr>
                </thead>
                <tbody class="
                    text-slate-700
                    dark:text-slate-200
                    divide-y
                    divide-slate-200
                    dark:divide-slate-700
                ">
                    @forelse($produkStokHabis as $index => $produk)
                    <tr>
                        <td class="py-4 px-6">
                            {{ $index + 1 }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $produk->nama }}
                        </td>
                        <td class="
                            text-center
                            py-4 px-6
                            font-semibold
                            text-red-600
                        ">
                            {{ $produk->stok }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3"
                            class="
                            text-center
                            py-8
                            text-slate-400
                            dark:text-slate-500
                        ">
                            Tidak ada produk habis stok
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
{{-- BEST SELLER --}}
<div class="
    bg-white dark:bg-[#162033]
    rounded-3xl
    shadow-xl
    p-4 sm:p-8
    transition-all
    duration-300
    hover:-translate-y-2
    hover:shadow-2xl
">
    <h3 class="
        text-lg sm:text-xl
        font-semibold
        text-[#0A2540]
        dark:text-white
        mb-6
        flex
        items-center
        gap-3
    ">
        🏆 Best Seller Products Hari Ini
    </h3>
    <div class="
        overflow-x-auto
        border border-slate-100
        dark:border-slate-700
        rounded-2xl
    ">
        <table class="w-full min-w-[600px]">
            <thead>
                <tr class="
                    border-b
                    border-slate-200
                    dark:border-slate-700
                ">
                    <th class="
                        text-left
                        py-4 px-6
                        text-slate-500
                        dark:text-slate-400
                        font-medium
                    ">
                        Nama Produk
                    </th>
                    <th class="
                        text-center
                        py-4 px-6
                        text-slate-500
                        dark:text-slate-400
                        font-medium
                    ">
                        Stok Saat Ini
                    </th>
                    <th class="
                        text-center
                        py-4 px-6
                        text-slate-500
                        dark:text-slate-400
                        font-medium
                    ">
                        Unit Terjual
                    </th>
                </tr>
            </thead>
            <tbody class="
                text-slate-700
                dark:text-slate-200
                divide-y
                divide-slate-200
                dark:divide-slate-700
            ">
                @forelse($produkTerlaris as $produk)
                <tr>
                    <td class="
                        py-4
                        px-6
                        font-medium
                    ">
                        {{ $produk->nama }}
                    </td>
                    <td class="
                        text-center
                        py-4
                        px-6
                    ">
                        {{ $produk->stok }}
                    </td>
                    <td class="
                        text-center
                        py-4
                        px-6
                        font-semibold
                        text-emerald-600
                    ">
                        {{ $produk->total_terjual ?? 0 }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3"
                        class="
                        text-center
                        py-8
                        text-slate-400
                        dark:text-slate-500">
                        Belum ada penjualan hari ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection