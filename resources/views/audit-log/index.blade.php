@extends('layouts.app')

@section('title', 'Audit Log')

@section('content')
<div class="space-y-6">
    <x-page-header
        title="Audit Log"
        subtitle="Riwayat perubahan penting dan aktivitas pengguna di dalam sistem."
        label="System Activity"
        icon="fa-shield-halved" />

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-700 dark:bg-slate-800">
        <form method="GET" action="{{ route('admin.audit-log.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-6">
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" value="{{ $filters['tanggal_awal'] ?? '' }}" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" value="{{ $filters['tanggal_akhir'] ?? '' }}" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Pengguna</label>
                <select name="user_id" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                    <option value="">Semua</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @selected((string) ($filters['user_id'] ?? '') === (string) $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Aksi</label>
                <select name="action" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                    <option value="">Semua</option>
                    @foreach(['CREATE', 'UPDATE', 'DELETE', 'LOGIN', 'LOGOUT', 'EXPORT', 'PAYMENT'] as $action)
                        <option value="{{ $action }}" @selected(($filters['action'] ?? '') === $action)>{{ $action }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Modul</label>
                <select name="module" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                    <option value="">Semua</option>
                    @foreach($modules as $module)
                        <option value="{{ $module }}" @selected(($filters['module'] ?? '') === $module)>{{ $module }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Cari</label>
                <div class="flex gap-2">
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Nama/IP/keterangan" class="min-w-0 flex-1 rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                    <button class="rounded-xl bg-[#0A2540] px-4 text-white"><i class="fa-solid fa-filter"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-lg dark:border-slate-700 dark:bg-slate-800">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase text-slate-500 dark:bg-slate-700/60 dark:text-slate-300">
                    <tr><th class="px-5 py-4">Waktu</th><th class="px-5 py-4">Pengguna</th><th class="px-5 py-4">Aksi</th><th class="px-5 py-4">Modul</th><th class="px-5 py-4">Keterangan</th><th class="px-5 py-4">Perubahan</th><th class="px-5 py-4">IP</th></tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($logs as $log)
                        @php
                            $warna = match($log->action) {
                                'CREATE' => 'bg-emerald-50 text-emerald-700',
                                'UPDATE' => 'bg-blue-50 text-blue-700',
                                'DELETE' => 'bg-red-50 text-red-700',
                                'EXPORT' => 'bg-violet-50 text-violet-700',
                                'PAYMENT' => 'bg-amber-50 text-amber-700',
                                default => 'bg-slate-100 text-slate-700',
                            };
                        @endphp
                        <tr class="align-top hover:bg-slate-50 dark:hover:bg-slate-700/40">
                            <td class="whitespace-nowrap px-5 py-4">{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                            <td class="px-5 py-4 font-semibold">{{ optional($log->user)->name ?? 'Sistem' }}</td>
                            <td class="px-5 py-4"><span class="rounded-full px-3 py-1 text-xs font-bold {{ $warna }}">{{ $log->action }}</span></td>
                            <td class="px-5 py-4">{{ $log->module }}</td>
                            <td class="min-w-[240px] px-5 py-4">{{ $log->description }}</td>
                            <td class="min-w-[260px] px-5 py-4 text-xs">
                                @if($log->old_values || $log->new_values)
                                    <details><summary class="cursor-pointer font-semibold text-blue-600">Lihat detail</summary><div class="mt-2 space-y-2 break-all"><div><b>Sebelum:</b> {{ json_encode($log->old_values, JSON_UNESCAPED_UNICODE) ?: '-' }}</div><div><b>Sesudah:</b> {{ json_encode($log->new_values, JSON_UNESCAPED_UNICODE) ?: '-' }}</div></div></details>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 font-mono text-xs">{{ $log->ip_address ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-5 py-12 text-center text-slate-500">Belum ada aktivitas yang tercatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="border-t border-slate-100 px-5 py-4 dark:border-slate-700">{{ $logs->links() }}</div>
        @endif
    </div>
</div>
@endsection
