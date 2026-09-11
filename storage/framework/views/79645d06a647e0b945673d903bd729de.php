<?php $__env->startSection('title', 'Pembayaran QRIS'); ?>

<?php $__env->startSection('content'); ?>

<?php
    $isGateway = $penjualan->gateway_provider === 'MIDTRANS';
    $status = $penjualan->payment_status ?? 'UNPAID';

    $statusLabel = match($status) {
        'DEMO_PENDING', 'PENDING', 'UNPAID' => 'Menunggu Pembayaran',
        'PAID', 'SETTLEMENT', 'SUCCESS' => 'Pembayaran Berhasil',
        'FAILED', 'EXPIRE', 'EXPIRED' => 'Pembayaran Gagal / Kedaluwarsa',
        default => $status,
    };

    $isPaid = in_array($status, [
        'PAID',
        'SETTLEMENT',
        'SUCCESS'
    ]);

    $isFailed = in_array($status, [
        'FAILED',
        'EXPIRE',
        'EXPIRED'
    ]);
?>

<div class="mx-auto max-w-lg">

    <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-xl dark:border-slate-700 dark:bg-slate-800">

        
        <div class="bg-gradient-to-r from-[#0A2540] to-[#1E3A8A] px-6 py-7 text-center text-white">

            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15">
                <i class="fa-solid fa-qrcode text-2xl"></i>
            </div>

            <h1 class="text-2xl font-bold">
                Pembayaran QRIS
            </h1>

            <p class="mt-1 text-sm text-blue-100">
                Transaksi #<?php echo e($penjualan->id); ?>

            </p>

        </div>


        
        <div class="p-6 text-center">

            
            <?php if(!$isGateway): ?>

                <div class="mb-5 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-left text-sm text-amber-800">

                    <b>QRIS GoPay Resmi.</b>

                    Pembayaran akan masuk ke akun merchant GoPay dan
                    dikonfirmasi secara manual melalui aplikasi POS.

                </div>

            <?php else: ?>

                <div class="mb-5 rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-left text-sm text-blue-800">

                    <b>
                        Midtrans
                        <?php echo e(config('services.midtrans.is_production') ? 'Production' : 'Sandbox'); ?>.
                    </b>

                    Transaksi akan selesai setelah notifikasi pembayaran
                    resmi diterima aplikasi.

                </div>

            <?php endif; ?>


            
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Total Pembayaran
            </p>

            <p class="mb-5 mt-1 text-3xl font-bold text-[#0A2540] dark:text-white">

                Rp <?php echo e(number_format(
                    $penjualan->total_pembayaran,
                    0,
                    ',',
                    '.'
                )); ?>


            </p>


            
            <div class="mb-5 flex justify-center">

                <div class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">

                    <img
                        src="<?php echo e($isGateway
                            ? $penjualan->payment_qr_url
                            : asset('images/qris.png')); ?>"
                        alt="QRIS Pembayaran"
                        class="h-[250px] w-[250px] object-contain"
                    >

                </div>

            </div>


            
            <div
                id="payment-status"
                data-status-url="<?php echo e(route('penjualan.payment-status', $penjualan->id)); ?>"
                class="
                    mb-4 inline-flex items-center gap-2 rounded-full
                    px-5 py-2 text-sm font-semibold

                    <?php if($isPaid): ?>
                        bg-emerald-50 text-emerald-700
                    <?php elseif($isFailed): ?>
                        bg-red-50 text-red-700
                    <?php else: ?>
                        bg-amber-50 text-amber-700
                    <?php endif; ?>
                "
            >

                
                <span
                    id="status-dot"
                    class="
                        h-2 w-2 rounded-full

                        <?php if($isPaid): ?>
                            bg-emerald-500
                        <?php elseif($isFailed): ?>
                            bg-red-500
                        <?php else: ?>
                            animate-pulse bg-amber-500
                        <?php endif; ?>
                    "
                ></span>

                <span>
                    Status:
                    <span id="status-text">
                        <?php echo e($statusLabel); ?>

                    </span>
                </span>

            </div>


            
            <p class="mb-5 text-sm text-slate-500 dark:text-slate-400">

                <?php if($isPaid): ?>

                    Pembayaran telah berhasil dikonfirmasi.

                <?php elseif($isFailed): ?>

                    Pembayaran gagal atau kode QRIS telah kedaluwarsa.

                <?php else: ?>

                    Scan QRIS dan bayarkan sesuai total transaksi.

                <?php endif; ?>


                <?php if(
                    $isGateway &&
                    $penjualan->payment_expired_at &&
                    !$isPaid
                ): ?>

                    <br>

                    Kode berlaku sampai

                    <?php echo e($penjualan->payment_expired_at->format('d-m-Y H:i')); ?>.

                <?php endif; ?>

            </p>


            
            <?php if(!$isGateway): ?>

                <?php if(!$isPaid): ?>

                    <form
                        action="<?php echo e(route(
                            'penjualan.bayar',
                            $penjualan->id
                        )); ?>"
                        method="POST"
                    >

                        <?php echo csrf_field(); ?>

                        <button
                            type="submit"
                            class="
                                w-full rounded-xl bg-emerald-600
                                py-3 font-semibold text-white
                                transition hover:bg-emerald-700
                            "
                        >

                            <i class="fa-solid fa-check mr-2"></i>

                            Konfirmasi Pembayaran

                        </button>

                    </form>

                <?php else: ?>

                    <div class="rounded-xl bg-emerald-50 px-4 py-3 font-semibold text-emerald-700">

                        <i class="fa-solid fa-circle-check mr-2"></i>

                        Pembayaran Berhasil

                    </div>

                <?php endif; ?>


            
            <?php else: ?>

                <p class="rounded-xl bg-slate-50 px-4 py-3 text-xs text-slate-500 dark:bg-slate-700 dark:text-slate-300">

                    Status pembayaran diperiksa secara otomatis.
                    Tidak diperlukan konfirmasi pembayaran manual.

                </p>

            <?php endif; ?>

        </div>

    </div>

</div>



<?php if($isGateway): ?>

<script>

document.addEventListener('DOMContentLoaded', () => {

    const statusBox = document.getElementById('payment-status');
    const statusText = document.getElementById('status-text');
    const statusDot = document.getElementById('status-dot');
    const statusUrl = statusBox.dataset.statusUrl;


    const statusLabels = {

        DEMO_PENDING: 'Menunggu Pembayaran',
        PENDING: 'Menunggu Pembayaran',
        UNPAID: 'Menunggu Pembayaran',

        PAID: 'Pembayaran Berhasil',
        SETTLEMENT: 'Pembayaran Berhasil',
        SUCCESS: 'Pembayaran Berhasil',

        FAILED: 'Pembayaran Gagal / Kedaluwarsa',
        EXPIRE: 'Pembayaran Gagal / Kedaluwarsa',
        EXPIRED: 'Pembayaran Gagal / Kedaluwarsa'

    };


    const checkStatus = async () => {

        try {

            const response = await fetch(
                statusUrl,
                {
                    headers: {
                        'Accept': 'application/json'
                    },

                    credentials: 'same-origin'
                }
            );


            if (!response.ok) {
                return;
            }


            const data = await response.json();

            const status = data.status ?? 'PENDING';

            statusText.textContent =
                statusLabels[status] ?? status;


            /*
             * BERHASIL
             */
            if (data.paid) {

                statusBox.className =
                    'mb-4 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-5 py-2 text-sm font-semibold text-emerald-700';

                statusDot.className =
                    'h-2 w-2 rounded-full bg-emerald-500';


                if (data.redirect_url) {

                    setTimeout(() => {

                        window.location.href =
                            data.redirect_url;

                    }, 1000);

                }

                return;

            }


            /*
             * GAGAL / EXPIRED
             */
            if (
                [
                    'FAILED',
                    'EXPIRE',
                    'EXPIRED'
                ].includes(status)
            ) {

                statusBox.className =
                    'mb-4 inline-flex items-center gap-2 rounded-full bg-red-50 px-5 py-2 text-sm font-semibold text-red-700';

                statusDot.className =
                    'h-2 w-2 rounded-full bg-red-500';

                return;

            }


            /*
             * MENUNGGU
             */
            statusBox.className =
                'mb-4 inline-flex items-center gap-2 rounded-full bg-amber-50 px-5 py-2 text-sm font-semibold text-amber-700';

            statusDot.className =
                'h-2 w-2 animate-pulse rounded-full bg-amber-500';


        } catch (error) {

            console.error(
                'Gagal memeriksa status pembayaran:',
                error
            );

        }

    };


    checkStatus();

    setInterval(
        checkStatus,
        4000
    );

});

</script>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos\resources\views/penjualan/qris.blade.php ENDPATH**/ ?>