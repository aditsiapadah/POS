<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'user',
    'size' => 'md',
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
    'user',
    'size' => 'md',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $sizes = [
        'sm' => 'w-10 h-10 text-sm',
        'md' => 'w-11 h-11 text-base',
        'lg' => 'w-14 h-14 text-lg',
        'xl' => 'w-20 h-20 text-2xl',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $initial = mb_strtoupper(mb_substr($user->name, 0, 1));
?>

<?php if($user->foto): ?>
    <img
        src="<?php echo e(asset('storage/' . $user->foto)); ?>"
        alt="<?php echo e($user->name); ?>"
        <?php echo e($attributes->merge(['class' => "$sizeClass rounded-full object-cover ring-2 ring-white/10 shadow-lg"])); ?>>
<?php else: ?>
    <div
        <?php echo e($attributes->merge(['class' => "$sizeClass rounded-full bg-gradient-to-br from-[#1E3A8A] to-[#2563eb] flex items-center justify-center font-bold text-white ring-2 ring-white/10 shadow-lg"])); ?>>
        <?php echo e($initial); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\pos\resources\views/components/user-avatar.blade.php ENDPATH**/ ?>