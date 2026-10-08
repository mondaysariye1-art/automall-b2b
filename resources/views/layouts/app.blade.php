<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'AutoMall') }}</title>

    <script>
        (function () {
            const darkMode = localStorage.getItem('automall-dark-mode');

            if (darkMode === 'true') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white text-gray-900 transition-colors duration-200 dark:bg-gray-950 dark:text-gray-100">
        {{ $slot }}
    </div>

<style>
    html.dark {
        background: #09090b;
    }

    html.dark body {
        background: #09090b;
        color: #f4f4f5;
    }

    html.dark input,
    html.dark textarea,
    html.dark select {
        background-color: #18181b;
        color: #f4f4f5;
        border-color: #3f3f46;
    }

    html.dark input::placeholder,
    html.dark textarea::placeholder {
        color: #a1a1aa;
    }

    html.dark .bg-white {
        background-color: #18181b !important;
    }

    html.dark .bg-gray-50 {
        background-color: #09090b !important;
    }

    html.dark .text-gray-900 {
        color: #f4f4f5 !important;
    }

    html.dark .text-gray-800 {
        color: #e4e4e7 !important;
    }

    html.dark .text-gray-700 {
        color: #d4d4d8 !important;
    }

    html.dark .text-gray-600 {
        color: #a1a1aa !important;
    }

    html.dark .text-gray-500 {
        color: #a1a1aa !important;
    }

    html.dark .border-gray-200 {
        border-color: #27272a !important;
    }

    html.dark .border-gray-300 {
        border-color: #3f3f46 !important;
    }


    /* SIDEBAR COLLAPSE ONLY */

    .automall-sidebar {
        transition: width 0.25s ease;
    }

    .automall-sidebar.collapsed {
        width: 76px !important;
    }

    .automall-sidebar.collapsed .nav-text {
        display: none !important;
    }

    .automall-sidebar.collapsed .automall-user-info {
        display: none !important;
    }

    .automall-sidebar.collapsed .automall-user {
        justify-content: center;
    }

    .automall-sidebar.collapsed .automall-nav-link {
        justify-content: center;
    }

    .automall-sidebar.collapsed .automall-brand-full {
        display: none !important;
    }

    .automall-sidebar.collapsed .automall-brand-small {
        display: inline !important;
    }

    .automall-main-content {
        margin-left: 260px;
        transition: margin-left 0.25s ease;
    }

    .automall-sidebar.collapsed ~ .automall-main-content {
        margin-left: 76px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const sidebar = document.querySelector('.automall-sidebar');
        const toggle = document.querySelector('#sidebarToggle');

        if (!sidebar || !toggle) {
            return;
        }

        const saved = localStorage.getItem('automall-sidebar-collapsed');

        if (saved === 'true') {
            sidebar.classList.add('collapsed');
        }

        toggle.addEventListener('click', function () {

            sidebar.classList.toggle('collapsed');

            localStorage.setItem(
                'automall-sidebar-collapsed',
                sidebar.classList.contains('collapsed')
            );

        });

    });
</script>

</body>
</html>