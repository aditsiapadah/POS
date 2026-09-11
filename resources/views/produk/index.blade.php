@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')

<div class="space-y-6">

    {{-- Judul + Tombol --}}
    <x-page-header
        title="Data Produk"
        subtitle="Lihat dan kelola data produk, harga, serta stok."
        label="Product Management"
        icon="fa-box">
        @if(strtolower((string) optional(auth()->user()->role)->name) === 'admin')
        <x-slot:actions>
            <a href="{{ route('produk.create') }}"
                class="inline-flex items-center gap-2
                px-4 py-2 sm:px-5 sm:py-3
                rounded-xl
                bg-white
                text-[#0A2540]
                hover:bg-blue-50
                shadow-lg
                hover:shadow-xl
                transition-all duration-200
                font-semibold
                text-xs sm:text-sm">
                <i class="fa-solid fa-plus text-sm sm:text-base"></i>
                <span class="hidden sm:inline">Tambah Produk</span>
                <span class="sm:hidden">Tambah</span>
            </a>
        </x-slot:actions>
        @endif
    </x-page-header>

    {{-- Search --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-4 md:p-6 mb-8">
        <form method="GET" action="{{ route('produk.index') }}">
            <div class="relative mobile-search">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-gray-400 dark:text-gray-500"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama produk..."
                    class="w-full border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700
                    text-gray-800 dark:text-white
                    placeholder-gray-400
                    rounded-xl py-3 pl-11 pr-4
                    focus:ring-2 focus:ring-[#0A2540]
                    outline-none">
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-hidden">
        {{-- Desktop Table View --}}
        <div class="overflow-x-auto desktop-table hidden-mobile">
            <table class="w-full">

                <thead class="bg-gray-50 dark:bg-slate-700">
                    <tr class="text-left text-gray-500 dark:text-gray-200">
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">#</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Foto</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Nama Produk</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base hidden lg:table-cell">Jenis Produk</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base hidden md:table-cell">Harga Pokok</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Harga Jual</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Stok</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($produk as $index => $item)

                    <tr class="border-t border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition">

                        {{-- Nomor --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            {{ $produk->firstItem() + $index }}
                        </td>

                        {{-- Foto --}}
                        <td class="px-6 py-4 md:px-8 md:py-5">
                            @if($item->foto)
                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama }}"
                                    class="w-12 h-12 md:w-14 md:h-14 rounded-lg object-cover border dark:border-slate-600">
                            @else
                                <span class="text-gray-400 dark:text-gray-500 text-sm">
                                    Tidak ada
                                </span>
                            @endif
                        </td>

                        {{-- Nama --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 font-semibold text-gray-900 dark:text-white text-sm md:text-base">
                            {{ $item->nama }}
                        </td>

                        {{-- Jenis Produk --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 hidden lg:table-cell text-sm md:text-base">
                            {{ $item->jenisProduk->nama ?? '-' }}
                        </td>

                        {{-- Harga Pokok --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 hidden md:table-cell text-sm md:text-base">
                            Rp {{ number_format($item->harga_beli) }}
                        </td>

                        {{-- Harga Jual --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            Rp {{ number_format($item->harga_jual) }}
                        </td>

                        {{-- Stok --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            {{ $item->stok }}
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 md:px-8 md:py-5">

                            <div class="flex justify-center gap-2 mobile-actions">

                                {{-- Detail --}}
                                <a href="{{ route('produk.show', $item->id) }}"
                                    class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg bg-blue-500 hover:bg-blue-600 flex items-center justify-center text-white transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @if(strtolower((string) optional(auth()->user()->role)->name) === 'admin')
                                {{-- Edit --}}
                                <a href="{{ route('produk.edit', $item->id) }}"
                                    class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg bg-yellow-400 hover:bg-yellow-500 flex items-center justify-center text-white transition">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('produk.destroy', $item->id) }}"
                                    method="POST"
                                    class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg bg-red-500 hover:bg-red-600 text-white transition">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>
                                @endif

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="text-center py-10 text-gray-500 dark:text-gray-300">

                            Tidak ada data produk

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        {{-- Mobile Card View --}}
        <div class="mobile-card-view p-4 space-y-4">
            @forelse($produk as $index => $item)
            <div class="bg-gray-50 dark:bg-slate-700 rounded-xl p-4 border border-gray-200 dark:border-slate-600">
                <div class="flex items-start gap-4">
                    @if($item->foto)
                        <img
                            src="{{ asset('storage/' . $item->foto) }}"
                            alt="{{ $item->nama }}"
                            class="w-16 h-16 rounded-lg object-cover border dark:border-slate-600 shrink-0">
                    @else
                        <div class="w-16 h-16 rounded-lg bg-gray-200 dark:bg-slate-600 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-box text-gray-400 dark:text-gray-500 text-xl"></i>
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg">{{ $item->nama }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $item->jenisProduk->nama ?? '-' }}</p>
                        <div class="mt-2 flex items-center gap-3 text-sm">
                            <span class="text-gray-700 dark:text-gray-200">Stok: {{ $item->stok }}</span>
                            <span class="text-green-600 dark:text-green-400 font-semibold">Rp {{ number_format($item->harga_jual) }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 grid {{ strtolower((string) optional(auth()->user()->role)->name) === 'admin' ? 'grid-cols-3' : 'grid-cols-1' }} gap-2 mobile-actions">
                    <a href="{{ route('produk.show', $item->id) }}"
                        class="mobile-touch-target flex items-center justify-center gap-2
                            bg-blue-500 hover:bg-blue-600
                            text-white rounded-lg py-3 transition font-medium text-xs">
                        <i class="fa-solid fa-eye"></i>
                        Detail
                    </a>

                    @if(strtolower((string) optional(auth()->user()->role)->name) === 'admin')
                    <a href="{{ route('produk.edit', $item->id) }}"
                        class="mobile-touch-target flex items-center justify-center gap-2
                            bg-yellow-400 hover:bg-yellow-500
                            text-white rounded-lg py-3 transition font-medium text-xs">
                        <i class="fa-solid fa-pen"></i>
                        Edit
                    </a>

                    <form action="{{ route('produk.destroy', $item->id) }}"
                        method="POST"
                        class="delete-form">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="mobile-touch-target w-full flex items-center justify-center gap-2
                                bg-red-500 hover:bg-red-600
                                text-white rounded-lg py-3 transition font-medium text-xs">
                            <i class="fa-solid fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center py-10 text-gray-500 dark:text-gray-300">
                Tidak ada data produk
            </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 dark:text-white">
        {{ $produk->links() }}
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}",
    confirmButtonColor: '#0A2540'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Tidak dapat dihapus',
    text: "{{ session('error') }}",
    confirmButtonColor: '#d33'
});
</script>
@endif

<script>
document.querySelectorAll('.delete-form').forEach(function(form) {

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        Swal.fire({
            title: 'Hapus Produk?',
            text: 'Apakah Anda yakin ingin menghapus produk ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});

// Mobile view toggle
function handleMobileView() {
    const isMobile = window.innerWidth <= 768;
    const desktopTable = document.querySelector('.desktop-table');
    const mobileCardView = document.querySelector('.mobile-card-view');

    if (isMobile) {
        if (desktopTable) desktopTable.classList.add('hidden-mobile');
        if (mobileCardView) mobileCardView.classList.add('active');
    } else {
        if (desktopTable) desktopTable.classList.remove('hidden-mobile');
        if (mobileCardView) mobileCardView.classList.remove('active');
    }
}

// Initialize and handle resize
document.addEventListener('DOMContentLoaded', handleMobileView);
window.addEventListener('resize', handleMobileView);
</script>

@endsection
