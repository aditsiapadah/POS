@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')

<div class="space-y-6">

    {{-- Judul + Tombol Tambah --}}
    <x-page-header
        title="Data Penjualan"
        subtitle="Kelola transaksi penjualan dan informasi pembayaran MitraMart POS."
        label="Sales Management"
        icon="fa-cart-shopping">
        <x-slot:actions>
            <a href="{{ route('penjualan.create') }}"
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
                <span class="hidden sm:inline">Tambah Penjualan</span>
                <span class="sm:hidden">Tambah</span>
            </a>
        </x-slot:actions>
    </x-page-header>


    {{-- Search --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-4 md:p-6 mb-8">

        <form method="GET" action="{{ route('penjualan.index') }}">

            <div class="relative mobile-search">

                <i class="fa-solid fa-magnifying-glass
                    absolute left-4 top-4
                    text-gray-400 dark:text-gray-500">
                </i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari transaksi / kasir..."
                    class="w-full
                    border border-gray-300 dark:border-slate-600
                    bg-white dark:bg-slate-700
                    text-gray-800 dark:text-white
                    placeholder-gray-400 dark:placeholder-gray-400
                    rounded-xl py-3 pl-11 pr-4
                    focus:ring-2 focus:ring-[#0A2540]
                    outline-none">

            </div>

        </form>

    </div>


    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-x-auto">

        <table class="w-full min-w-[900px]">

            {{-- Header Table --}}
            <thead class="bg-gray-50 dark:bg-slate-700">

                <tr class="text-left text-gray-500 dark:text-gray-200">
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">#</th>
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Tanggal Transaksi</th>
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Kasir</th>
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Total Pembayaran</th>
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base hidden md:table-cell">Metode</th>
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Status</th>
                    <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base text-center">Aksi</th>
                </tr>
            </thead>

            {{-- Body Table --}}
            <tbody>
                @forelse($penjualan as $index => $item)
                    <tr class="border-t
                        border-gray-200 dark:border-slate-700
                        hover:bg-gray-50 dark:hover:bg-slate-700
                        transition">

                        {{-- Nomor --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            {{ $penjualan->firstItem() + $index }}
                        </td>

                        {{-- Tanggal Transaksi --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            {{
                                \Carbon\Carbon::parse(
                                    $item->tanggal_transaksi ?? $item->created_at
                                )->format('d-m-Y H:i')
                            }}
                        </td>

                        {{-- Kasir --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 font-semibold text-gray-900 dark:text-white text-sm md:text-base">
                            {{ $item->user->name ?? $item->user->nama ?? '-' }}
                        </td>

                        {{-- Total Pembayaran --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            Rp {{ number_format(
                                $item->total_pembayaran ?? $item->total ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}
                        </td>

                        {{-- Metode Pembayaran --}}
                        <td class="px-6 py-4 md:px-8 md:py-5 hidden md:table-cell">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{
                                    ($item->metode_pembayaran ?? $item->metode) == 'CASH'
                                    ? 'bg-green-100 text-green-700
                                    dark:bg-green-900 dark:text-green-200'
                                    : (
                                        ($item->metode_pembayaran ?? $item->metode) == 'TRANSFER'
                                        ? 'bg-yellow-100 text-yellow-700
                                        dark:bg-yellow-900 dark:text-yellow-200'
                                        : 'bg-blue-100 text-blue-700
                                        dark:bg-blue-900 dark:text-blue-200'
                                    )
                                }}">
                                {{ $item->metode_pembayaran ?? $item->metode ?? '-' }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4 md:px-8 md:py-5">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{
                                    ($item->status ?? '') == 'COMPLETED'
                                    ? 'bg-emerald-100 text-emerald-700
                                    dark:bg-emerald-900 dark:text-emerald-200'
                                    : 'bg-amber-100 text-amber-700
                                    dark:bg-amber-900 dark:text-amber-200'
                                }}">
                                {{ $item->status ?? 'OPEN' }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 md:px-8 md:py-5">
                            <div class="flex justify-center gap-2 mobile-actions">
                                {{-- ========================== --}}
                                {{-- STATUS COMPLETED --}}
                                {{-- ========================== --}}
                                @if($item->status === 'COMPLETED')
                                    {{-- Detail --}}
                                    <a href="{{ route('penjualan.show', $item->id) }}"
                                        class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                        bg-blue-500 hover:bg-blue-600
                                        flex items-center justify-center
                                        text-white transition"
                                        title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- Cetak Struk --}}
                                    <a href="{{ route('penjualan.cetak', $item->id) }}"
                                        target="_blank"
                                        class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                        bg-green-500 hover:bg-green-600
                                        flex items-center justify-center
                                        text-white transition"
                                        title="Cetak Struk">
                                        <i class="fa-solid fa-print"></i>
                                    </a>
                                @endif
                                    {{-- ========================== --}}
                                    {{-- EDIT --}}
                                    {{-- ========================== --}}
                                    @if($item->status === 'COMPLETED')
                                        {{-- Edit Disabled --}}
                                        <button
                                            type="button"
                                            onclick="transaksiSelesai()"
                                            class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                            bg-gray-400
                                            cursor-not-allowed
                                            flex items-center justify-center
                                            text-white transition"
                                            title="Transaksi sudah selesai">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    @else
                                        {{-- Edit OPEN --}}
                                        <a href="{{ route('penjualan.edit', $item->id) }}"
                                            class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                            bg-yellow-400 hover:bg-yellow-500
                                            flex items-center justify-center
                                            text-white transition"
                                            title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    @endif
                                    {{-- ========================== --}}
                                    {{-- HAPUS HANYA STATUS OPEN --}}
                                    {{-- ========================== --}}
                                    @if($item->status === 'OPEN')
                                        <form
                                            action="{{ route('penjualan.destroy', $item->id) }}"
                                            method="POST"
                                            class="form-hapus-penjualan">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                                bg-red-500 hover:bg-red-600
                                                flex items-center justify-center
                                                text-white transition"
                                                title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                            </div>
                        </td>
                    </tr>
                @empty

                    {{-- Tidak Ada Data --}}
                    <tr>
                        <td
                            colspan="7"
                            class="text-center py-10
                            text-gray-500 dark:text-gray-300">
                            Tidak ada data penjualan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 dark:text-white">
        {{ $penjualan->links() }}
    </div>
</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- ============================== --}}
{{-- SUCCESS ALERT --}}
{{-- ============================== --}}
    @if(session('success'))
        <div id="success-message"
            data-message="{{ session('success') }}"
            class="hidden"></div>

        <script>
            const successElement = document.getElementById('success-message');
            const successMessage = successElement?.dataset.message;

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: successMessage,
                    confirmButtonColor: '#0A2540'
                });
            }
        </script>
    @endif

    @if(session('error'))
        <div id="error-message"
            data-message="{{ session('error') }}"
            class="hidden"></div>

        <script>
            const errorElement = document.getElementById('error-message');
            const errorMessage = errorElement?.dataset.message;

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Dapat Dihapus',
                    text: errorMessage,
                    confirmButtonColor: '#d33'
                });
            }
        </script>
    @endif
{{-- ============================== --}}
{{-- KONFIRMASI HAPUS --}}
{{-- ============================== --}}
<script>
document.querySelectorAll('.form-hapus-penjualan').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Hapus Transaksi?',
            text: 'Apakah Anda yakin ingin menghapus transaksi penjualan ini?',
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

function transaksiSelesai() {
    Swal.fire({
        icon: 'warning',
        title: 'Transaksi Sudah Selesai',
        text: 'Transaksi yang sudah selesai tidak dapat diedit.',
        confirmButtonColor: '#0A2540'
    });
}
</script>

@endsection
