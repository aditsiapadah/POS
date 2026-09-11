<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>
        <?php echo $__env->yieldContent('title', 'MitraMart POS'); ?>
    </title>



    
    <script src="https://cdn.tailwindcss.com"></script>


    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>




    
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">






    
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
        if (localStorage.getItem('sidebar') === 'collapsed') {
            document.documentElement.classList.add('sidebar-collapsed');
        }
    </script>





    <style>
        body {
            font-family: 'Inter', sans-serif;
        }



        .menu-active {
            background: #1E3A8A;
        }




        :root {
            --sidebar-width: 260px;
        }

        html.sidebar-collapsed {
            --sidebar-width: 80px;
        }

        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            height: 100dvh;
            z-index: 50;
            transition: width 0.25s ease, transform 0.25s ease;
        }

        .sidebar-overlay {
            display: none;
        }

        .sidebar-close-btn {
            display: none;
        }






        .content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            transition: margin-left 0.25s ease, width 0.25s ease;
        }







        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: 64px;
            z-index: 40;
            transition: left 0.25s ease;
        }

        html.sidebar-collapsed .sidebar-label,
        html.sidebar-collapsed .sidebar-brand-text,
        html.sidebar-collapsed .sidebar-section-title,
        html.sidebar-collapsed .sidebar-user-info {
            display: none;
        }

        html.sidebar-collapsed .sidebar-nav-link {
            justify-content: center;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        html.sidebar-collapsed .sidebar-logo,
        html.sidebar-collapsed .sidebar-user-row {
            justify-content: center;
        }

        html.sidebar-collapsed .sidebar-inner {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }







        .page {
            padding: 95px 32px 32px;
        }

        @media (max-width: 1023px) {
            html.sidebar-collapsed {
                --sidebar-width: 260px;
            }

            html.sidebar-collapsed .sidebar-label,
            html.sidebar-collapsed .sidebar-brand-text,
            html.sidebar-collapsed .sidebar-section-title,
            html.sidebar-collapsed .sidebar-user-info {
                display: block;
            }

            html.sidebar-collapsed .sidebar-nav-link {
                justify-content: flex-start;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            html.sidebar-collapsed .sidebar-logo {
                justify-content: flex-start;
            }

            html.sidebar-collapsed .sidebar-user-row {
                justify-content: flex-start;
            }

            html.sidebar-collapsed .sidebar-inner {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            html.sidebar-collapsed .sidebar-close-btn {
                display: flex;
            }

            .sidebar {
                width: min(280px, 86vw);
                transform: translateX(-100%);
            }

            html.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.55);
                z-index: 45;
            }

            html.sidebar-open .sidebar-overlay {
                display: block;
            }

            html.sidebar-open {
                overflow: hidden;
            }

            .sidebar-close-btn {
                display: flex;
            }

            .content,
            .topbar {
                margin-left: 0;
                left: 0;
                width: 100%;
            }

            .page {
                padding: 80px 16px 24px;
            }
        }

        @media (max-width: 640px) {
            .page {
                padding: 70px 12px 20px;
            }

            .sidebar {
                width: min(260px, 100vw);
            }
        }





        /* CARD HOVER ANIMATION */

        .card-hover {

            transition: all 0.3s ease;

        }


        .card-hover:hover {

            transform: translateY(-8px);

            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

        }




        /* TABLE CARD HOVER */

        .table-hover {

            transition: all 0.3s ease;

        }


        .table-hover:hover {

            transform: translateY(-8px);

            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

        }

        /* Mobile Responsive Table */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scroll-behavior: smooth;
            }

            .table-responsive table {
                min-width: 600px;
            }

            /* Custom scrollbar for better UX */
            .table-responsive::-webkit-scrollbar {
                height: 8px;
            }

            .table-responsive::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 4px;
            }

            .table-responsive::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 4px;
            }

            .table-responsive::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            /* Mobile card view for table rows */
            .mobile-card-view {
                display: none;
            }

            .mobile-card-view.active {
                display: block;
            }

            .desktop-table {
                display: table;
            }

            .desktop-table.hidden-mobile {
                display: none;
            }

            /* Larger touch targets for mobile */
            .mobile-touch-target {
                min-width: 44px;
                min-height: 44px;
            }

            /* Improved spacing for mobile */
            .mobile-spacing {
                padding: 12px;
            }

            /* Responsive search box */
            .mobile-search {
                width: 100% !important;
            }

            /* Responsive action buttons */
            .mobile-actions {
                flex-wrap: wrap;
                gap: 8px;
            }

            .mobile-actions a,
            .mobile-actions button {
                flex: 1;
                min-width: 44px;
                justify-content: center;
            }
        }

        @media (min-width: 769px) {
            .mobile-card-view {
                display: none !important;
            }

            .desktop-table.hidden-mobile {
                display: table;
            }
        }

        /* Global smooth scrolling for all tables */
        .overflow-x-auto {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
        }

        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Dark mode scrollbar */
        .dark .overflow-x-auto::-webkit-scrollbar-track {
            background: #334155;
        }

        .dark .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #64748b;
        }

        .dark .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>


</head>







<body class="bg-slate-100 dark:bg-slate-900">






    <?php if(auth()->check()): ?>



    
    <div class="sidebar">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <div id="sidebar-overlay" class="sidebar-overlay" aria-hidden="true"></div>







    

    <div class="content">





        

        <div class="topbar">

            <?php echo $__env->make('layouts.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </div>








        

        <div class="page">

            <?php echo $__env->yieldContent('content'); ?>

        </div>







    </div>







    <?php else: ?>



    

    <?php echo $__env->yieldContent('content'); ?>



    <?php endif; ?>







    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>






    <?php if(session('success')): ?>

    <script>
        Swal.fire({

            title: 'Berhasil!',

            text: "<?php echo e(session('success')); ?>",

            icon: 'success',

            confirmButtonColor: '#0A2540',

            confirmButtonText: 'OK',

            timer: 2500,

            timerProgressBar: true

        });
    </script>

    <?php endif; ?>







    <?php if(auth()->check()): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const html = document.documentElement;
            const toggleBtn = document.getElementById('sidebar-toggle');
            const closeBtn = document.getElementById('sidebar-close');
            const overlay = document.getElementById('sidebar-overlay');

            function isMobile() {
                return window.matchMedia('(max-width: 1023px)').matches;
            }

            function setDesktopCollapsed(collapsed) {
                html.classList.toggle('sidebar-collapsed', collapsed);
                localStorage.setItem('sidebar', collapsed ? 'collapsed' : 'expanded');
            }

            function setMobileOpen(open) {
                html.classList.toggle('sidebar-open', open);
            }

            function closeMobileSidebar() {
                setMobileOpen(false);
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    if (isMobile()) {
                        setMobileOpen(!html.classList.contains('sidebar-open'));
                    } else {
                        setDesktopCollapsed(!html.classList.contains('sidebar-collapsed'));
                    }
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeMobileSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeMobileSidebar);
            }

            document.querySelectorAll('.sidebar a').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (isMobile()) {
                        closeMobileSidebar();
                    }
                });
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeMobileSidebar();
                }
            });

            window.addEventListener('resize', function () {
                if (!isMobile()) {
                    closeMobileSidebar();
                }
            });
        });
    </script>
    <?php endif; ?>

    <?php if(session('error')): ?>

    <script>
        Swal.fire({

            title: 'Gagal!',

            text: "<?php echo e(session('error')); ?>",

            icon: 'error',

            confirmButtonColor: '#0A2540',

            confirmButtonText: 'OK'

        });
    </script>

    <?php endif; ?>





</body>


</html>
<?php /**PATH C:\laragon\www\pos\resources\views/layouts/app.blade.php ENDPATH**/ ?>