<?php $__env->startSection('title', 'Audit Log'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Audit Log','subtitle' => 'Riwayat perubahan penting dan aktivitas pengguna di dalam sistem.','label' => 'System Activity','icon' => 'fa-shield-halved']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Audit Log','subtitle' => 'Riwayat perubahan penting dan aktivitas pengguna di dalam sistem.','label' => 'System Activity','icon' => 'fa-shield-halved']); ?>
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

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg dark:border-slate-700 dark:bg-slate-800">
        <form method="GET" action="<?php echo e(route('admin.audit-log.index')); ?>" class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-6">
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" value="<?php echo e($filters['tanggal_awal'] ?? ''); ?>" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" value="<?php echo e($filters['tanggal_akhir'] ?? ''); ?>" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Pengguna</label>
                <select name="user_id" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                    <option value="">Semua</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php if((string) ($filters['user_id'] ?? '') === (string) $user->id): echo 'selected'; endif; ?>><?php echo e($user->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Aksi</label>
                <select name="action" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                    <option value="">Semua</option>
                    <?php $__currentLoopData = ['CREATE', 'UPDATE', 'DELETE', 'LOGIN', 'LOGOUT', 'EXPORT', 'PAYMENT']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($action); ?>" <?php if(($filters['action'] ?? '') === $action): echo 'selected'; endif; ?>><?php echo e($action); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Modul</label>
                <select name="module" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
                    <option value="">Semua</option>
                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($module); ?>" <?php if(($filters['module'] ?? '') === $module): echo 'selected'; endif; ?>><?php echo e($module); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="mb-2 block text-xs font-semibold text-slate-600 dark:text-slate-300">Cari</label>
                <div class="flex gap-2">
                    <input type="text" name="search" value="<?php echo e($filters['search'] ?? ''); ?>" placeholder="Nama/IP/keterangan" class="min-w-0 flex-1 rounded-xl border border-slate-300 bg-white px-3 py-2.5 dark:border-slate-600 dark:bg-slate-700 dark:text-white">
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
                    <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $warna = match($log->action) {
                                'CREATE' => 'bg-emerald-50 text-emerald-700',
                                'UPDATE' => 'bg-blue-50 text-blue-700',
                                'DELETE' => 'bg-red-50 text-red-700',
                                'EXPORT' => 'bg-violet-50 text-violet-700',
                                'PAYMENT' => 'bg-amber-50 text-amber-700',
                                default => 'bg-slate-100 text-slate-700',
                            };
                        ?>
                        <tr class="align-top hover:bg-slate-50 dark:hover:bg-slate-700/40">
                            <td class="whitespace-nowrap px-5 py-4"><?php echo e($log->created_at->format('d-m-Y H:i:s')); ?></td>
                            <td class="px-5 py-4 font-semibold"><?php echo e(optional($log->user)->name ?? 'Sistem'); ?></td>
                            <td class="px-5 py-4"><span class="rounded-full px-3 py-1 text-xs font-bold <?php echo e($warna); ?>"><?php echo e($log->action); ?></span></td>
                            <td class="px-5 py-4"><?php echo e($log->module); ?></td>
                            <td class="min-w-[240px] px-5 py-4"><?php echo e($log->description); ?></td>
                            <td class="min-w-[260px] px-5 py-4 text-xs">
                                <?php if($log->old_values || $log->new_values): ?>
                                    <details><summary class="cursor-pointer font-semibold text-blue-600">Lihat detail</summary><div class="mt-2 space-y-2 break-all"><div><b>Sebelum:</b> <?php echo e(json_encode($log->old_values, JSON_UNESCAPED_UNICODE) ?: '-'); ?></div><div><b>Sesudah:</b> <?php echo e(json_encode($log->new_values, JSON_UNESCAPED_UNICODE) ?: '-'); ?></div></div></details>
                                <?php else: ?>
                                    <span class="text-slate-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 font-mono text-xs"><?php echo e($log->ip_address ?? '-'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="7" class="px-5 py-12 text-center text-slate-500">Belum ada aktivitas yang tercatat.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($logs->hasPages()): ?>
            <div class="border-t border-slate-100 px-5 py-4 dark:border-slate-700"><?php echo e($logs->links()); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos\resources\views/audit-log/index.blade.php ENDPATH**/ ?>