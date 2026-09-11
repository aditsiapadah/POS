@props([
    'user',
    'size' => 'md',
])

@php
    $sizes = [
        'sm' => 'w-10 h-10 text-sm',
        'md' => 'w-11 h-11 text-base',
        'lg' => 'w-14 h-14 text-lg',
        'xl' => 'w-20 h-20 text-2xl',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $initial = mb_strtoupper(mb_substr($user->name, 0, 1));
@endphp

@if($user->foto)
    <img
        src="{{ asset('storage/' . $user->foto) }}"
        alt="{{ $user->name }}"
        {{ $attributes->merge(['class' => "$sizeClass rounded-full object-cover ring-2 ring-white/10 shadow-lg"]) }}>
@else
    <div
        {{ $attributes->merge(['class' => "$sizeClass rounded-full bg-gradient-to-br from-[#1E3A8A] to-[#2563eb] flex items-center justify-center font-bold text-white ring-2 ring-white/10 shadow-lg"]) }}>
        {{ $initial }}
    </div>
@endif
