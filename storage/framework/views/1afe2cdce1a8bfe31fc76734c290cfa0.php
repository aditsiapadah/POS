<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Halaman',
    'subtitle' => '',
    'label' => 'Management',
    'icon' => 'fa-layer-group',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => 'Halaman',
    'subtitle' => '',
    'label' => 'Management',
    'icon' => 'fa-layer-group',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>


<div class="relative overflow-hidden rounded-3xl
    bg-gradient-to-br from-[#0A2540] via-[#12395f] to-[#2563eb]
    px-4 py-4 sm:px-6 sm:py-6 md:px-8 md:py-7
    shadow-xl">

    
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

    
    <div class="absolute right-8 top-5
        opacity-10 pointer-events-none hidden sm:block">

        <i class="fa-solid <?php echo e($icon); ?>

            text-[120px] text-white">
        </i>

    </div>

    
    <div class="relative
        flex flex-col
        sm:flex-row
        sm:items-center
        sm:justify-between
        gap-4 sm:gap-5">

        
        <div class="flex-1 min-w-0">

            
            <div class="flex items-center gap-2 sm:gap-3 mb-2">

                
                <div class="w-8 h-8 sm:w-10 sm:h-10
                    rounded-xl
                    bg-white/15
                    backdrop-blur
                    border border-white/20
                    flex items-center
                    justify-center
                    text-white
                    shadow-lg shrink-0">

                    <i class="fa-solid <?php echo e($icon); ?> text-sm sm:text-base"></i>

                </div>

                
                <span class="text-blue-100
                    text-[10px] sm:text-xs
                    font-semibold
                    uppercase
                    tracking-wider truncate">

                    <?php echo e($label); ?>


                </span>

            </div>

            
            <h1 class="text-xl sm:text-2xl md:text-3xl
                font-bold
                text-white
                tracking-tight truncate">

                <?php echo e($title); ?>


            </h1>

            
            <?php if($subtitle): ?>
                <p class="text-blue-100
                    text-xs sm:text-sm
                    mt-1
                    max-w-2xl line-clamp-2">

                    <?php echo e($subtitle); ?>


                </p>
            <?php endif; ?>

        </div>

        
        <?php if(isset($actions)): ?>
            <div class="relative z-10
                flex items-center
                gap-2 shrink-0">

                <?php echo e($actions); ?>


            </div>
        <?php endif; ?>

    </div>

</div><?php /**PATH C:\laragon\www\pos\resources\views/components/page-header.blade.php ENDPATH**/ ?>