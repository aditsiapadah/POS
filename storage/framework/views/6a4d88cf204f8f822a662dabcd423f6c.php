<?php $__env->startSection('title', 'Data Produk'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-6">

    
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Data Produk','subtitle' => 'Lihat dan kelola data produk, harga, serta stok.','label' => 'Product Management','icon' => 'fa-box']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Produk','subtitle' => 'Lihat dan kelola data produk, harga, serta stok.','label' => 'Product Management','icon' => 'fa-box']); ?>
        <?php if(strtolower((string) optional(auth()->user()->role)->name) === 'admin'): ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('produk.create')); ?>"
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
         <?php $__env->endSlot(); ?>
        <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

    
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg p-4 md:p-6 mb-8">
        <form method="GET" action="<?php echo e(route('produk.index')); ?>">
            <div class="relative mobile-search">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-gray-400 dark:text-gray-500"></i>

                <input
                    type="text"
                    name="search"
                    value="<?php echo e(request('search')); ?>"
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

    
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-hidden">
        
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

                    <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr class="border-t border-gray-200 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 transition">

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            <?php echo e($produk->firstItem() + $index); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5">
                            <?php if($item->foto): ?>
                                <img
                                    src="<?php echo e(asset('storage/' . $item->foto)); ?>"
                                    alt="<?php echo e($item->nama); ?>"
                                    class="w-12 h-12 md:w-14 md:h-14 rounded-lg object-cover border dark:border-slate-600">
                            <?php else: ?>
                                <span class="text-gray-400 dark:text-gray-500 text-sm">
                                    Tidak ada
                                </span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 font-semibold text-gray-900 dark:text-white text-sm md:text-base">
                            <?php echo e($item->nama); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 hidden lg:table-cell text-sm md:text-base">
                            <?php echo e($item->jenisProduk->nama ?? '-'); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 hidden md:table-cell text-sm md:text-base">
                            Rp <?php echo e(number_format($item->harga_beli)); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            Rp <?php echo e(number_format($item->harga_jual)); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            <?php echo e($item->stok); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5">

                            <div class="flex justify-center gap-2 mobile-actions">

                                
                                <a href="<?php echo e(route('produk.show', $item->id)); ?>"
                                    class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg bg-blue-500 hover:bg-blue-600 flex items-center justify-center text-white transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <?php if(strtolower((string) optional(auth()->user()->role)->name) === 'admin'): ?>
                                
                                <a href="<?php echo e(route('produk.edit', $item->id)); ?>"
                                    class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg bg-yellow-400 hover:bg-yellow-500 flex items-center justify-center text-white transition">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                
                                <form action="<?php echo e(route('produk.destroy', $item->id)); ?>"
                                    method="POST"
                                    class="delete-form">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button
                                        type="submit"
                                        class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg bg-red-500 hover:bg-red-600 text-white transition">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>
                                <?php endif; ?>

                            </div>

                        </td>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>

                        <td colspan="8"
                            class="text-center py-10 text-gray-500 dark:text-gray-300">

                            Tidak ada data produk

                        </td>

                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>
        </div>

        
        <div class="mobile-card-view p-4 space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-gray-50 dark:bg-slate-700 rounded-xl p-4 border border-gray-200 dark:border-slate-600">
                <div class="flex items-start gap-4">
                    <?php if($item->foto): ?>
                        <img
                            src="<?php echo e(asset('storage/' . $item->foto)); ?>"
                            alt="<?php echo e($item->nama); ?>"
                            class="w-16 h-16 rounded-lg object-cover border dark:border-slate-600 shrink-0">
                    <?php else: ?>
                        <div class="w-16 h-16 rounded-lg bg-gray-200 dark:bg-slate-600 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-box text-gray-400 dark:text-gray-500 text-xl"></i>
                        </div>
                    <?php endif; ?>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg"><?php echo e($item->nama); ?></h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm"><?php echo e($item->jenisProduk->nama ?? '-'); ?></p>
                        <div class="mt-2 flex items-center gap-3 text-sm">
                            <span class="text-gray-700 dark:text-gray-200">Stok: <?php echo e($item->stok); ?></span>
                            <span class="text-green-600 dark:text-green-400 font-semibold">Rp <?php echo e(number_format($item->harga_jual)); ?></span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 grid <?php echo e(strtolower((string) optional(auth()->user()->role)->name) === 'admin' ? 'grid-cols-3' : 'grid-cols-1'); ?> gap-2 mobile-actions">
                    <a href="<?php echo e(route('produk.show', $item->id)); ?>"
                        class="mobile-touch-target flex items-center justify-center gap-2
                            bg-blue-500 hover:bg-blue-600
                            text-white rounded-lg py-3 transition font-medium text-xs">
                        <i class="fa-solid fa-eye"></i>
                        Detail
                    </a>

                    <?php if(strtolower((string) optional(auth()->user()->role)->name) === 'admin'): ?>
                    <a href="<?php echo e(route('produk.edit', $item->id)); ?>"
                        class="mobile-touch-target flex items-center justify-center gap-2
                            bg-yellow-400 hover:bg-yellow-500
                            text-white rounded-lg py-3 transition font-medium text-xs">
                        <i class="fa-solid fa-pen"></i>
                        Edit
                    </a>

                    <form action="<?php echo e(route('produk.destroy', $item->id)); ?>"
                        method="POST"
                        class="delete-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button type="submit"
                            class="mobile-touch-target w-full flex items-center justify-center gap-2
                                bg-red-500 hover:bg-red-600
                                text-white rounded-lg py-3 transition font-medium text-xs">
                            <i class="fa-solid fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-10 text-gray-500 dark:text-gray-300">
                Tidak ada data produk
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="mt-6 dark:text-white">
        <?php echo e($produk->links()); ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(session('success')): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "<?php echo e(session('success')); ?>",
    confirmButtonColor: '#0A2540'
});
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Tidak dapat dihapus',
    text: "<?php echo e(session('error')); ?>",
    confirmButtonColor: '#d33'
});
</script>
<?php endif; ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos\resources\views/produk/index.blade.php ENDPATH**/ ?>