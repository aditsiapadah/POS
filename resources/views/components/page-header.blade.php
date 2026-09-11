@props([
    'title' => 'Halaman',
    'subtitle' => '',
    'label' => 'Management',
    'icon' => 'fa-layer-group',
])

{{-- =========================================================
    PAGE HEADER
========================================================= --}}
<div class="relative overflow-hidden rounded-3xl
    bg-gradient-to-br from-[#0A2540] via-[#12395f] to-[#2563eb]
    px-4 py-4 sm:px-6 sm:py-6 md:px-8 md:py-7
    shadow-xl">

    {{-- Decorative Circle --}}
    <div class="absolute -top-24 -right-20
        w-64 h-64
        bg-white/10
        rounded-full
        blur-2xl">
    </div>

    <div class="absolute -bottom-20 -left-16
        w-48 h-48
        bg-blue-400/10
        rounded-full
        blur-3xl">
    </div>

    {{-- Decorative Icon --}}
    <div class="absolute right-8 top-5
        opacity-10 pointer-events-none hidden sm:block">

        <i class="fa-solid {{ $icon }}
            text-[120px] text-white">
        </i>

    </div>

    {{-- Content --}}
    <div class="relative
        flex flex-col
        sm:flex-row
        sm:items-center
        sm:justify-between
        gap-4 sm:gap-5">

        {{-- Left Content --}}
        <div class="flex-1 min-w-0">

            {{-- Label --}}
            <div class="flex items-center gap-2 sm:gap-3 mb-2">

                {{-- Icon Box --}}
                <div class="w-8 h-8 sm:w-10 sm:h-10
                    rounded-xl
                    bg-white/15
                    backdrop-blur
                    border border-white/20
                    flex items-center
                    justify-center
                    text-white
                    shadow-lg shrink-0">

                    <i class="fa-solid {{ $icon }} text-sm sm:text-base"></i>

                </div>

                {{-- Label --}}
                <span class="text-blue-100
                    text-[10px] sm:text-xs
                    font-semibold
                    uppercase
                    tracking-wider truncate">

                    {{ $label }}

                </span>

            </div>

            {{-- Title --}}
            <h1 class="text-xl sm:text-2xl md:text-3xl
                font-bold
                text-white
                tracking-tight truncate">

                {{ $title }}

            </h1>

            {{-- Subtitle --}}
            @if($subtitle)
                <p class="text-blue-100
                    text-xs sm:text-sm
                    mt-1
                    max-w-2xl line-clamp-2">

                    {{ $subtitle }}

                </p>
            @endif

        </div>

        {{-- Optional Right Content --}}
        @if(isset($actions))
            <div class="relative z-10
                flex items-center
                gap-2 shrink-0">

                {{ $actions }}

            </div>
        @endif

    </div>

</div>