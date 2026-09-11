@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <x-page-header
        title="Data Users"
        subtitle="Kelola akun pengguna dan hak akses sistem MitraMart POS."
        label="User Management"
        icon="fa-users">
        <x-slot:actions>
            <a href="{{ route('admin.users.create') }}"
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
                <i class="fa-solid fa-user-plus text-sm sm:text-base"></i>
                <span class="hidden sm:inline">Tambah User</span>
                <span class="sm:hidden">Tambah</span>
            </a>
        </x-slot:actions>
    </x-page-header>

    {{-- Search --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-4 md:p-6">

        <form method="GET"
            action="{{ route('admin.users') }}"
            class="relative mobile-search">

            <i class="fa-solid fa-search absolute left-4 top-3.5 text-gray-400 dark:text-gray-500"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama user..."
                class="w-full pl-11 py-3 rounded-xl
                       border border-gray-300 dark:border-slate-600
                       bg-white dark:bg-slate-700
                       text-gray-800 dark:text-white
                       placeholder-gray-400 dark:placeholder-gray-400
                       focus:ring-2 focus:ring-[#0A2540]
                       focus:outline-none">
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
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Nama</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base hidden md:table-cell">Email</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base">Role</th>
                        <th class="px-6 py-4 md:px-8 md:py-5 text-sm md:text-base text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $index => $user)

                    <tr class="border-t border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition">

                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            {{ $users->firstItem() + $index }}
                        </td>

                        <td class="px-6 py-4 md:px-8 md:py-5">
                            <x-user-avatar :user="$user" size="lg" />
                        </td>

                        <td class="px-6 py-4 md:px-8 md:py-5 font-semibold text-gray-900 dark:text-white text-sm md:text-base">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-600 dark:text-gray-300 hidden md:table-cell text-sm md:text-base">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4 md:px-8 md:py-5">
                            @if($user->role->name == 'Admin')
                                <span class="bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 px-3 py-1 rounded-full text-xs md:text-sm">
                                    Admin
                                </span>
                            @else
                                <span class="bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200 px-3 py-1 rounded-full text-xs md:text-sm">
                                    Kasir
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 md:px-8 md:py-5">

                            <div class="flex justify-center gap-2 mobile-actions">

                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                        bg-yellow-400 hover:bg-yellow-500
                                        flex items-center justify-center
                                        text-white transition">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                @if($user->id != auth()->id())

                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                        method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                                bg-red-500 hover:bg-red-600
                                                flex items-center justify-center
                                                text-white transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-10 text-gray-500 dark:text-gray-300">

                            Tidak ada data user

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        {{-- Mobile Card View --}}
        <div class="mobile-card-view p-4 space-y-4">
            @forelse($users as $index => $user)
            <div class="bg-gray-50 dark:bg-slate-700 rounded-xl p-4 border border-gray-200 dark:border-slate-600">
                <div class="flex items-start gap-4">
                    <x-user-avatar :user="$user" size="lg" />
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg">{{ $user->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm truncate">{{ $user->email }}</p>
                        <div class="mt-2">
                            @if($user->role->name == 'Admin')
                                <span class="bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 px-3 py-1 rounded-full text-xs">
                                    Admin
                                </span>
                            @else
                                <span class="bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200 px-3 py-1 rounded-full text-xs">
                                    Kasir
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex gap-2 mobile-actions">
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                        class="mobile-touch-target flex-1 flex items-center justify-center gap-2
                            bg-yellow-400 hover:bg-yellow-500
                            text-white rounded-lg py-3 transition font-medium text-sm">
                        <i class="fa-solid fa-pen"></i>
                        Edit
                    </a>

                    @if($user->id != auth()->id())
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                            method="POST"
                            class="delete-form flex-1">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="mobile-touch-target w-full flex items-center justify-center gap-2
                                    bg-red-500 hover:bg-red-600
                                    text-white rounded-lg py-3 transition font-medium text-sm">
                                <i class="fa-solid fa-trash"></i>
                                Hapus
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center py-10 text-gray-500 dark:text-gray-300">
                Tidak ada data user
            </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-8 dark:text-white">
        {{ $users->links() }}
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
    title: 'Gagal',
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
            title: 'Hapus User?',
            text: 'Apakah Anda yakin ingin menghapus user ini?',
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
