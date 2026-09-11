@extends('layouts.app')

@section('title', 'Data Jenis Produk')

@section('content')

<div class="space-y-6">

    {{-- Judul + Tombol --}}
    <x-page-header
        title="Data Jenis Produk"
        subtitle="Kelola kategori atau jenis produk yang tersedia di MitraMart POS."
        label="Product Category"
        icon="fa-tags">
        @if(strtolower((string) optional(auth()->user()->role)->name) === 'admin')
        <x-slot:actions>
            <a href="{{ route('jenis-produk.create') }}"
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
                <i class="fa-solid fa-tags text-sm sm:text-base"></i>
                <span class="hidden sm:inline">Tambah Jenis Produk</span>
                <span class="sm:hidden">Tambah</span>
            </a>
        </x-slot:actions>
        @endif
    </x-page-header>

    {{-- Search --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-4 md:p-6 mb-8">
        <form method="GET" action="{{ route('jenis-produk.index') }}">
            <div class="relative mobile-search">
                <i class="fa-solid fa-magnifying-glass
                absolute left-4 top-4
                text-gray-400 dark:text-gray-500"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari jenis produk..."
                    class="
                    w-full
                    border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700
                    text-gray-800 dark:text-white
                    placeholder-gray-400
                    rounded-xl
                    py-3 pl-11 pr-4
                    focus:ring-2 focus:ring-[#0A2540]
                    outline-none"
                >
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-x-auto">
        <table class="w-full min-w-[600px]">
            <thead class="bg-gray-50 dark:bg-slate-700">
                <tr class="text-left text-gray-500 dark:text-gray-200">
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">#</th>
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Nama Jenis</th>
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base text-center">Stok</th>
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisProduks as $index => $item)
                <tr class="
                border-t border-gray-200
                dark:border-slate-700
                hover:bg-gray-50
                dark:hover:bg-slate-700
                transition">

                    <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                        {{ $jenisProduks->firstItem() + $index }}
                    </td>

                    <td class="
                    px-6 py-4 md:px-8 md:py-5
                    font-semibold
                    text-gray-900
                    dark:text-white text-sm md:text-base">
                        {{ $item->nama }}
                    </td>

                    <td class="px-6 py-4 md:px-8 md:py-5 text-center">
                        <span class="inline-flex items-center justify-center min-w-[2.5rem] px-3 py-1 rounded-full text-xs md:text-sm font-semibold
                            {{ $item->produk_count > 0
                                ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300'
                                : 'bg-gray-100 text-gray-500 dark:bg-slate-700 dark:text-gray-400' }}">
                            {{ $item->produk_count }}
                        </span>
                    </td>

                    <td class="px-6 py-4 md:px-8 md:py-5">
                        @if(strtolower((string) optional(auth()->user()->role)->name) === 'admin')
                        <div class="flex justify-center gap-2 mobile-actions">

                            <a href="{{ route('jenis-produk.edit', $item->id) }}"
                                class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                bg-yellow-400 hover:bg-yellow-500
                                flex items-center justify-center
                                text-white transition">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('jenis-produk.destroy', $item->id) }}"
                                method="POST"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                    bg-red-500 hover:bg-red-600
                                    text-white transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        @else
                            <span class="block text-center text-sm text-gray-400 dark:text-gray-500">Hanya Admin</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4"
                        class="
                        text-center py-10
                        text-gray-500
                        dark:text-gray-300">
                        Tidak ada data jenis produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 dark:text-white">
        {{ $jenisProduks->links() }}
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
document.querySelectorAll('.delete-form').forEach(function(form){
    form.addEventListener('submit', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Hapus Jenis Produk?',
            text: 'Apakah Anda yakin ingin menghapus jenis produk ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result)=>{
            if(result.isConfirmed){
                form.submit();
            }
        });
    });
});
</script>

@endsection
