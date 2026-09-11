<?php $__env->startSection('title', $mode == 'create' ? 'Tambah Penjualan' : 'Edit Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-7xl mx-auto">

    
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6 sm:mb-8">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0A2540] dark:text-white leading-tight">
            <?php echo e($mode == 'create' ? 'Tambah Penjualan (POS)' : 'Edit Transaksi Penjualan'); ?>

        </h1>
        <a href="<?php echo e(route('penjualan.index')); ?>"
            class="inline-flex items-center justify-center shrink-0 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-xl shadow transition font-semibold">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    
    <?php if(session('errors') || session('error')): ?>
    <div class="mb-5 bg-red-100 border border-red-300 text-red-700 px-5 py-3 rounded-xl">
        <?php echo e(session('errors') ?? session('error')); ?>

    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-[#0A2540] mb-4">Pilih Produk</h2>

            
            <form method="GET" action="<?php echo e(url()->current()); ?>" class="mb-6">
                <div class="relative w-full">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-gray-400"></i>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                        placeholder="Cari nama produk..."
                        class="w-full border border-gray-300 rounded-xl py-3 pl-11 pr-4 focus:ring-2 focus:ring-[#0A2540] outline-none">
                </div>
            </form>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[500px] overflow-y-auto pr-2">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="border border-gray-200 rounded-2xl p-4 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <h3 class="font-bold text-gray-800"><?php echo e($prod->nama); ?></h3>
                        <p class="text-[#0A2540] font-semibold mt-1">Rp <?php echo e(number_format($prod->harga_jual, 0, ',', '.')); ?></p>
                        <p class="text-xs text-gray-500 mt-1">Stok: <?php echo e($prod->stok); ?></p>
                    </div>

                    
                    <form action="<?php echo e(route('itempenjualan.store')); ?>" method="POST" class="mt-4 flex items-center gap-2">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="penjualan_id" value="<?php echo e($sale->id); ?>">

                        <input type="hidden" name="produk_id" value="<?php echo e($prod->id); ?>">

                        <input
                            type="number"
                            name="kuantitas"
                            value="1"
                            min="1"
                            max="<?php echo e($prod->stok); ?>"
                            class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-center"
                        >

                        <button type="submit"
                            class="flex-1 bg-[#0A2540] text-white py-2 rounded-lg">
                            Tambah
                        </button>
                    </form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-500 col-span-2 text-center py-8">Produk tidak ditemukan</p>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-white rounded-3xl shadow-lg p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-bold text-[#0A2540] mb-4">Keranjang Belanja</h2>

                <div class="divide-y divide-gray-100 max-h-[300px] overflow-y-auto mb-4">
                    <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="py-3 flex justify-between items-center">
                        <div class="pr-2">
                            <h4 class="font-semibold text-gray-800 text-sm"><?php echo e($item->produk->nama ?? 'Produk'); ?></h4>
                            <p class="text-xs text-gray-500"><?php echo e($item->kuantitas); ?>x @ Rp <?php echo e(number_format($item->harga_satuan ?? $item->produk->harga_jual ?? 0, 0, ',', '.')); ?></p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-sm text-[#0A2540]">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></p>
                            
                            <form action="<?php echo e(route('itempenjualan.destroy', $item->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs mt-1">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-400 text-center py-8 text-sm">Keranjang masih kosong</p>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between items-center text-lg font-bold text-[#0A2540]">
                        <span>Total:</span>
                        <span>Rp <?php echo e(number_format($sale->total_pembayaran ?? 0, 0, ',', '.')); ?></span>
                    </div>
                </div>

                
                <form action="<?php echo e(route('penjualan.update', $sale->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" required
                            class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-[#0A2540] outline-none">
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH" <?php echo e(($sale->metode_pembayaran ?? '') == 'CASH' ? 'selected' : ''); ?>>CASH</option>
                            <option value="TRANSFER" <?php echo e(($sale->metode_pembayaran ?? '') == 'TRANSFER' ? 'selected' : ''); ?>>TRANSFER</option>
                            <option value="QRIS" <?php echo e(($sale->metode_pembayaran ?? '') == 'QRIS' ? 'selected' : ''); ?>>QRIS</option>
                        </select>
                    </div>

                    <div id="cash-payment-fields" class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4">
                        <label for="uang_dibayar" class="block text-sm font-semibold text-gray-700 mb-2">
                            Uang Dibayar
                        </label>
                        <input
                            type="number"
                            name="uang_dibayar"
                            id="uang_dibayar"
                            min="0"
                            step="1"
                            value="<?php echo e(old('uang_dibayar', $sale->uang_dibayar)); ?>"
                            placeholder="Masukkan nominal uang pelanggan"
                            class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-emerald-500 outline-none">

                        <div class="mt-3 flex justify-between font-semibold text-gray-700">
                            <span>Kembalian:</span>
                            <span id="kembalian-display" class="text-emerald-700">Rp 0</span>
                        </div>
                        <p id="cash-warning" class="mt-2 hidden text-sm font-medium text-red-600">
                            Uang dibayar masih kurang.
                        </p>
                    </div>

                     <div class="grid gap-4">

                            <button type="submit"
                                name="status"
                                value="OPEN"
                                class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-xl font-bold shadow-lg transition">
                                💾 Simpan OPEN
                            </button>

                            <button type="submit"
                                name="status"
                                value="COMPLETED"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-xl font-bold shadow-lg transition">
                                <i class="fa-solid fa-check mr-2"></i>
                                Selesaikan Transaksi
                            </button>

                        </div>

                    </form>

                    <hr class="my-6 border-gray-200">

                    
                    <form action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button type="submit"
                            onclick="return confirm('Batalkan transaksi ini?')"
                            class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-semibold transition">
                            <i class="fa-solid fa-trash mr-2"></i>
                            Batalkan Transaksi
                        </button>
                    </form>
            </div>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const paymentMethod = document.getElementById('payment_method');
    const cashFields = document.getElementById('cash-payment-fields');
    const paidInput = document.getElementById('uang_dibayar');
    const changeDisplay = document.getElementById('kembalian-display');
    const warning = document.getElementById('cash-warning');
    const total = <?php echo e((int) ($sale->total_pembayaran ?? 0)); ?>;
    const rupiah = new Intl.NumberFormat('id-ID');

    function updateChange() {
        const isCash = paymentMethod.value === 'CASH';
        cashFields.classList.toggle('hidden', !isCash);
        paidInput.disabled = !isCash;

        if (!isCash) {
            warning.classList.add('hidden');
            return;
        }

        const paid = Number(paidInput.value || 0);
        const change = Math.max(0, paid - total);
        changeDisplay.textContent = 'Rp ' + rupiah.format(change);
        warning.classList.toggle('hidden', paidInput.value === '' || paid >= total);
    }

    paymentMethod.addEventListener('change', updateChange);
    paidInput.addEventListener('input', updateChange);
    updateChange();
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>