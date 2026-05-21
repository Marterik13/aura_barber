<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <style>
            body { font-family: 'Inter', sans-serif; background-color: #0D0D0D; color: #F5F5F5; }
            .gold-text {
                background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728, #FBF5B7, #AA771C);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            /* Custom Dark Theme Overrides for Datatables - Greyish */
            .dark-table-container table { color: #F5F5F5 !important; }
            .dark-table-container thead th { background-color: #374151 !important; color: #D4AF37 !important; border-bottom: 1px solid #4B5563 !important; }
            .dark-table-container tbody td { background-color: #1F2937 !important; color: #F5F5F5 !important; border-bottom: 1px solid #4B5563 !important; }
            .dark-table-container tbody tr:hover td { background-color: #4B5563 !important; }
            .dark-table-container .bg-white { background-color: transparent !important; }
            .dark-table-container select, .dark-table-container input { background-color: #374151 !important; color: #FFF !important; border: 1px solid #4B5563 !important; }
            .dark-table-container .text-gray-500, .dark-table-container .text-gray-700, .dark-table-container .text-gray-900 { color: #D1D5DB !important; }
            .dark-table-container .border-gray-200 { border-color: #4B5563 !important; }
            .dark-table-container .bg-gray-50 { background-color: #374151 !important; }
            /* Paginator Fixes */
            .dark-table-container nav[role="navigation"] button, .dark-table-container nav[role="navigation"] a {
                background-color: #374151 !important;
                color: #D4AF37 !important;
                border-color: #4B5563 !important;
            }
            .dark-table-container nav[role="navigation"] span {
                color: #F5F5F5 !important;
            }
        </style>
    </head>
    <body class="bg-[#0D0D0D] text-[#F5F5F5]">
        <x-banner />

        <div class="min-h-screen bg-[#0D0D0D]">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-[#111] border-b border-gray-800 shadow-xl">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
