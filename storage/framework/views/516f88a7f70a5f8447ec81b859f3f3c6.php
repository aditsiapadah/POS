<?php $__env->startSection('title', 'Data Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-6">

    
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Data Penjualan','subtitle' => 'Kelola transaksi penjualan dan informasi pembayaran MitraMart POS.','label' => 'Sales Management','icon' => 'fa-cart-shopping']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Penjualan','subtitle' => 'Kelola transaksi penjualan dan informasi pembayaran MitraMart POS.','label' => 'Sales Management','icon' => 'fa-cart-shopping']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('penjualan.create')); ?>"
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
         <?php $__env->endSlot(); ?>
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

        <form method="GET" action="<?php echo e(route('penjualan.index')); ?>">

            <div class="relative mobile-search">

                <i class="fa-solid fa-magnifying-glass
                    absolute left-4 top-4
                    text-gray-400 dark:text-gray-500">
                </i>

                <input
                    type="text"
                    name="search"
                    value="<?php echo e(request('search')); ?>"
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


    
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg overflow-x-auto">

        <table class="w-full min-w-[900px]">

            
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

            
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $penjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-t
                        border-gray-200 dark:border-slate-700
                        hover:bg-gray-50 dark:hover:bg-slate-700
                        transition">

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            <?php echo e($penjualan->firstItem() + $index); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            <?php echo e(\Carbon\Carbon::parse(
                                    $item->tanggal_transaksi ?? $item->created_at
                                )->format('d-m-Y H:i')); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 font-semibold text-gray-900 dark:text-white text-sm md:text-base">
                            <?php echo e($item->user->name ?? $item->user->nama ?? '-'); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 text-gray-700 dark:text-gray-200 text-sm md:text-base">
                            Rp <?php echo e(number_format(
                                $item->total_pembayaran ?? $item->total ?? 0,
                                0,
                                ',',
                                '.'
                            )); ?>

                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5 hidden md:table-cell">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                <?php echo e(($item->metode_pembayaran ?? $item->metode) == 'CASH'
                                    ? 'bg-green-100 text-green-700
                                    dark:bg-green-900 dark:text-green-200'
                                    : (
                                        ($item->metode_pembayaran ?? $item->metode) == 'TRANSFER'
                                        ? 'bg-yellow-100 text-yellow-700
                                        dark:bg-yellow-900 dark:text-yellow-200'
                                        : 'bg-blue-100 text-blue-700
                                        dark:bg-blue-900 dark:text-blue-200'
                                    )); ?>">
                                <?php echo e($item->metode_pembayaran ?? $item->metode ?? '-'); ?>

                            </span>
                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                <?php echo e(($item->status ?? '') == 'COMPLETED'
                                    ? 'bg-emerald-100 text-emerald-700
                                    dark:bg-emerald-900 dark:text-emerald-200'
                                    : 'bg-amber-100 text-amber-700
                                    dark:bg-amber-900 dark:text-amber-200'); ?>">
                                <?php echo e($item->status ?? 'OPEN'); ?>

                            </span>
                        </td>

                        
                        <td class="px-6 py-4 md:px-8 md:py-5">
                            <div class="flex justify-center gap-2 mobile-actions">
                                
                                
                                
                                <?php if($item->status === 'COMPLETED'): ?>
                                    
                                    <a href="<?php echo e(route('penjualan.show', $item->id)); ?>"
                                        class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                        bg-blue-500 hover:bg-blue-600
                                        flex items-center justify-center
                                        text-white transition"
                                        title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    
                                    <a href="<?php echo e(route('penjualan.cetak', $item->id)); ?>"
                                        target="_blank"
                                        class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                        bg-green-500 hover:bg-green-600
                                        flex items-center justify-center
                                        text-white transition"
                                        title="Cetak Struk">
                                        <i class="fa-solid fa-print"></i>
                                    </a>
                                <?php endif; ?>
                                    
                                    
                                    
                                    <?php if($item->status === 'COMPLETED'): ?>
                                        
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
                                    <?php else: ?>
                                        
                                        <a href="<?php echo e(route('penjualan.edit', $item->id)); ?>"
                                            class="mobile-touch-target w-10 h-10 md:w-10 md:h-10 rounded-lg
                                            bg-yellow-400 hover:bg-yellow-500
                                            flex items-center justify-center
                                            text-white transition"
                                            title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    
                                    
                                    <?php if($item->status === 'OPEN'): ?>
                                        <form
                                            action="<?php echo e(route('penjualan.destroy', $item->id)); ?>"
                                            method="POST"
                                            class="form-hapus-penjualan">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
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
                                    <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    
                    <tr>
                        <td
                            colspan="7"
                            class="text-center py-10
                            text-gray-500 dark:text-gray-300">
                            Tidak ada data penjualan
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-6 dark:text-white">
        <?php echo e($penjualan->links()); ?>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <?php if(session('success')): ?>
        <div id="success-message"
            data-message="<?php echo e(session('success')); ?>"
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
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div id="error-message"
            data-message="<?php echo e(session('error')); ?>"
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
    <?php endif; ?>



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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos\resources\views/penjualan/index.blade.php ENDPATH**/ ?>