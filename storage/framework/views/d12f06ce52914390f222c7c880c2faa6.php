<div class="h-full text-white shadow-2xl overflow-hidden"
     style="background: linear-gradient(180deg, #0A2540 0%, #0B1220 100%);
            border-right: 1px solid rgba(255,255,255,0.08);">

    <!-- Logo -->
    <div class="sidebar-logo flex items-center gap-3 p-5 border-b border-white/10 min-h-[88px]">
        <div class="relative shrink-0">
            <div class="absolute inset-0 bg-white/20 rounded-full blur-md"></div>
            <img src="<?php echo e(asset('images/logo-sekolah.png')); ?>"
                 class="relative w-11 h-11 rounded-full object-cover ring-2 ring-white/20 shadow-lg"
                 alt="Logo">
        </div>

        <div class="sidebar-brand-text min-w-0 flex-1">
            <h1 class="font-bold text-lg tracking-wide text-white leading-tight">
                MITRAMART POS
            </h1>
            <p class="text-xs text-white/50">
                Sistem Kasir Digital
            </p>
        </div>

        <button type="button"
                id="sidebar-close"
                class="sidebar-close-btn w-9 h-9 shrink-0 items-center justify-center rounded-lg bg-white/10 text-white hover:bg-white/20"
                aria-label="Tutup menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <!-- Menu -->
    <div class="sidebar-inner mt-6 px-4 space-y-1 overflow-y-auto pb-44">

        <p class="sidebar-section-title text-[11px] text-white/40 uppercase tracking-wider mb-3 px-3 font-medium">
            Menu Utama
        </p>

        <!-- Dashboard -->
        <a href="<?php echo e(route('dashboard')); ?>"
           title="Dashboard"
           class="sidebar-nav-link group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           <?php echo e(request()->routeIs('dashboard')
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40'
                : 'hover:bg-white/10'); ?>">
            <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center
                 <?php echo e(request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10'); ?>">
                <i class="fa-solid fa-house text-sm"></i>
            </div>
            <span class="sidebar-label font-medium text-sm whitespace-nowrap">Dashboard</span>
        </a>

        <?php if(strtolower((string) optional(Auth::user()->role)->name) === 'admin'): ?>
        <!-- Users (hanya Admin) -->
        <a href="<?php echo e(route('admin.users')); ?>"
           title="Users"
            class="sidebar-nav-link group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
            <?php echo e(request()->routeIs('admin.users*')
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40'
                : 'hover:bg-white/10'); ?>">
            <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center
                <?php echo e(request()->routeIs('admin.users*')
                    ? 'bg-white/20'
                    : 'bg-white/5 group-hover:bg-white/10'); ?>">
                <i class="fa-solid fa-users text-sm"></i>
            </div>
            <span class="sidebar-label font-medium text-sm whitespace-nowrap">Users</span>
        </a>
        <?php endif; ?>

        <!-- Jenis Produk -->
        <a href="<?php echo e(route('jenis-produk.index')); ?>"
           title="Jenis Produk"
        class="sidebar-nav-link group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
        <?php echo e(request()->routeIs('jenis-produk.*')
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40'
                : 'hover:bg-white/10'); ?>">
            <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center
                <?php echo e(request()->routeIs('jenis-produk.*')
                    ? 'bg-white/20'
                    : 'bg-white/5 group-hover:bg-white/10'); ?>">
                <i class="fa-solid fa-tags text-sm"></i>
            </div>
            <span class="sidebar-label font-medium text-sm whitespace-nowrap">Jenis Produk</span>
        </a>

        <!-- Produk -->
        <a href="<?php echo e(route('produk.index')); ?>"
           title="Produk"
           class="sidebar-nav-link group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           <?php echo e(request()->routeIs('produk.*')
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40'
                : 'hover:bg-white/10'); ?>">
            <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center
                 <?php echo e(request()->routeIs('produk.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10'); ?>">
                <i class="fa-solid fa-box text-sm"></i>
            </div>
            <span class="sidebar-label font-medium text-sm whitespace-nowrap">Produk</span>
        </a>

        <!-- Penjualan -->
        <a href="<?php echo e(route('penjualan.index')); ?>"
           title="Penjualan"
           class="sidebar-nav-link group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           <?php echo e(request()->routeIs('penjualan.*')
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40'
                : 'hover:bg-white/10'); ?>">
            <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center
                 <?php echo e(request()->routeIs('penjualan.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10'); ?>">
                <i class="fa-solid fa-cart-shopping text-sm"></i>
            </div>
            <span class="sidebar-label font-medium text-sm whitespace-nowrap">Penjualan</span>
        </a>

        <!-- Laporan Penjualan -->
        <a href="<?php echo e(route('laporan.index')); ?>"
           title="Laporan Penjualan"
        class="sidebar-nav-link group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
        <?php echo e(request()->routeIs('laporan.*')
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40'
                : 'hover:bg-white/10'); ?>">
            <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center
                <?php echo e(request()->routeIs('laporan.*')
                    ? 'bg-white/20'
                    : 'bg-white/5 group-hover:bg-white/10'); ?>">
                <i class="fa-solid fa-chart-column text-sm"></i>
            </div>
            <span class="sidebar-label font-medium text-sm whitespace-nowrap">Laporan Penjualan</span>
        </a>

        <?php if(strtolower((string) optional(Auth::user()->role)->name) === 'admin'): ?>
        <!-- Audit Log (hanya Admin) -->
        <a href="<?php echo e(route('admin.audit-log.index')); ?>"
           title="Audit Log"
           class="sidebar-nav-link group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           <?php echo e(request()->routeIs('admin.audit-log.*')
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40'
                : 'hover:bg-white/10'); ?>">
            <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center
                 <?php echo e(request()->routeIs('admin.audit-log.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10'); ?>">
                <i class="fa-solid fa-shield-halved text-sm"></i>
            </div>
            <span class="sidebar-label font-medium text-sm whitespace-nowrap">Audit Log</span>
        </a>
        <?php endif; ?>

        <!-- Pengaturan -->
        <a href="<?php echo e(route('pengaturan.index')); ?>"
           title="Tentang Aplikasi"
           class="sidebar-nav-link group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
           <?php echo e(request()->routeIs('pengaturan.*')
                ? 'bg-gradient-to-r from-[#1E3A8A] to-[#2563eb] shadow-lg shadow-blue-900/40'
                : 'hover:bg-white/10'); ?>">
            <div class="w-8 h-8 shrink-0 rounded-lg flex items-center justify-center
                 <?php echo e(request()->routeIs('pengaturan.*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10'); ?>">
                <i class="fa-solid fa-gear text-sm"></i>
            </div>
            <span class="sidebar-label font-medium text-sm whitespace-nowrap">Tentang Aplikasi</span>
        </a>

    </div>

    <!-- User Profile + Logout -->
    <div class="absolute bottom-0 left-0 right-0 p-4">

        <div class="border-t border-white/10 pt-4 mb-3">
            <div class="sidebar-user-row flex items-center gap-3 px-2">
                <?php if (isset($component)) { $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-avatar','data' => ['user' => Auth::user()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e)): ?>
<?php $attributes = $__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e; ?>
<?php unset($__attributesOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e)): ?>
<?php $component = $__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e; ?>
<?php unset($__componentOriginalaa6ddd3b8ee0acee5a2d1d7ac5c7e40e); ?>
<?php endif; ?>

                <div class="sidebar-user-info overflow-hidden flex-1 min-w-0">
                    <p class="font-semibold text-sm truncate text-white">
                        <?php echo e(Auth::user()->name); ?>

                    </p>
                    <p class="text-xs text-white/50 truncate">
                        <?php echo e(Auth::user()->role->name ?? '-'); ?>

                    </p>
                </div>
            </div>
        </div>

        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit"
                    title="Logout"
                    class="sidebar-nav-link w-full flex items-center justify-center gap-2
                           bg-white/10 hover:bg-white/15
                           border border-white/10
                           text-white rounded-xl py-3 text-sm font-medium
                           transition-all duration-200 hover:shadow-lg">
                <i class="fa-solid fa-right-from-bracket text-sm"></i>
                <span class="sidebar-label">Logout</span>
            </button>
        </form>
    </div>
</div>
<?php /**PATH C:\laragon\www\pos\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>