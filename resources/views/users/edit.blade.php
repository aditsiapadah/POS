@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-[#0A2540] dark:text-white">
        Edit User
    </h1>
    <p class="text-gray-500 dark:text-gray-400 mt-2">
        Perbarui data user.
    </p>
</div>

<div class="bg-white dark:bg-slate-800 rounded-xl shadow p-8">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Foto --}}
            <div class="md:col-span-2 flex flex-col items-center">
                <div id="avatar-preview" class="mb-4">
                    @if($user->foto)
                        <img
                            src="{{ asset('storage/' . $user->foto) }}"
                            class="w-24 h-24 rounded-full object-cover ring-4 ring-slate-100 dark:ring-slate-700 shadow-lg">
                    @else
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#1E3A8A] to-[#2563eb] flex items-center justify-center text-3xl font-bold text-white ring-4 ring-slate-100 dark:ring-slate-700 shadow-lg">
                            {{ $user->initial }}
                        </div>
                    @endif
                </div>

                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">
                    Foto Profil
                </label>
                <input
                    type="file"
                    id="foto"
                    name="foto"
                    accept="image/*"
                    class="block w-full max-w-sm text-sm text-slate-700 dark:text-slate-300
                    file:mr-4 file:px-5 file:py-3 file:rounded-xl file:border-0
                    file:bg-[#0A2540] file:text-white hover:file:bg-[#12395f] cursor-pointer">
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                    Upload foto baru untuk mengganti. Kosongkan untuk tetap pakai foto/inisial saat ini.
                </p>
                @error('foto')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Nama</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-3 rounded-lg border dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:ring-2 focus:ring-blue-500">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-3 rounded-lg border dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:ring-2 focus:ring-blue-500">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Password Baru</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Kosongkan jika tidak diubah"
                    class="w-full px-4 py-3 rounded-lg border dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:ring-2 focus:ring-blue-500">
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-200">Role</label>
                <select
                    name="role_id"
                    class="w-full px-4 py-3 rounded-lg border dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:ring-2 focus:ring-blue-500">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                    @endforeach
                </select>
                @error('role_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex gap-3 mt-8">
            <a href="{{ route('admin.users') }}"
                class="bg-gray-500 text-white px-5 py-3 rounded-xl hover:bg-gray-600 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Kembali
            </a>
            <button type="submit"
                class="bg-[#0A2540] text-white px-5 py-3 rounded-xl hover:bg-[#12395f] transition">
                <i class="fa-solid fa-pen mr-2"></i>
                Update
            </button>
        </div>
    </form>
</div>

<div id="user-data"
    data-has-foto="{{ $user->foto ? 'true' : 'false' }}"
    data-foto-url="{{ $user->foto ? asset('storage/' . $user->foto) : '' }}">
</div>

<script>
    const nameInput = document.getElementById('name');
const fotoInput = document.getElementById('foto');
const avatarPreview = document.getElementById('avatar-preview');

const userData = document.getElementById('user-data');

const hasExistingFoto = userData.dataset.hasFoto === 'true';
const existingFotoUrl = userData.dataset.fotoUrl || null;

function renderInitial(name) {
    const initial = name.trim()?.charAt(0).toUpperCase() || '?';

    avatarPreview.innerHTML = `
        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#1E3A8A] to-[#2563eb]
                    flex items-center justify-center text-3xl font-bold text-white
                    ring-4 ring-slate-100 dark:ring-slate-700 shadow-lg">
            ${initial}
        </div>
    `;
}

nameInput.addEventListener('input', function () {
    if (!fotoInput.files.length && !hasExistingFoto) {
        renderInitial(this.value);
    }
});

fotoInput.addEventListener('change', function (e) {
    const file = e.target.files[0];

    if (!file) {
        if (hasExistingFoto && existingFotoUrl) {
            avatarPreview.innerHTML = `
                <img src="${existingFotoUrl}"
                     class="w-24 h-24 rounded-full object-cover
                            ring-4 ring-slate-100 dark:ring-slate-700 shadow-lg">
            `;
        } else {
            renderInitial(nameInput.value);
        }

        return;
    }

    const reader = new FileReader();

    reader.onload = function (event) {
        avatarPreview.innerHTML = `
            <img src="${event.target.result}"
                 class="w-24 h-24 rounded-full object-cover
                        ring-4 ring-slate-100 dark:ring-slate-700 shadow-lg">
        `;
    };

    reader.readAsDataURL(file);
});

// Tampilkan foto/avatar saat halaman pertama kali dibuka
if (hasExistingFoto && existingFotoUrl) {
    avatarPreview.innerHTML = `
        <img src="${existingFotoUrl}"
             class="w-24 h-24 rounded-full object-cover
                    ring-4 ring-slate-100 dark:ring-slate-700 shadow-lg">
    `;
} else {
    renderInitial(nameInput.value);
}
</script>

@endsection
