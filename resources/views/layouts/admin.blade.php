@props([
    'title' => config('app.name', 'Laravel'),
    'breadcrumbs' => [], 
]) 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <script src="https://kit.fontawesome.com/b2bb8bbf2e.js" crossorigin="anonymous"></script>

        <wireui:scripts />
        @wireUiScripts
        <style>
            body { font-family: 'Inter', sans-serif; background-color: #0D0D0D; color: #F5F5F5; }
            .gold-text {
                background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728, #FBF5B7, #AA771C);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            /* Custom Dark Theme Overrides for Datatables */
            .dark-table-container table { color: #F5F5F5 !important; }
            .dark-table-container thead th { background-color: #111 !important; color: #D4AF37 !important; border-bottom: 1px solid #333 !important; }
            .dark-table-container tbody td { background-color: #1A1A1A !important; color: #F5F5F5 !important; border-bottom: 1px solid #333 !important; }
            .dark-table-container tbody tr:hover td { background-color: #222 !important; }
            .dark-table-container .bg-white { background-color: transparent !important; }
            .dark-table-container select, .dark-table-container input { background-color: #111 !important; color: #FFF !important; border: 1px solid #333 !important; }
            .dark-table-container .text-gray-500, .dark-table-container .text-gray-700, .dark-table-container .text-gray-900 { color: #CCC !important; }
            .dark-table-container .border-gray-200 { border-color: #333 !important; }
            .dark-table-container .bg-gray-50 { background-color: #111 !important; }
            /* Paginator Fixes */
            .dark-table-container nav[role="navigation"] button, .dark-table-container nav[role="navigation"] a {
                background-color: #111 !important;
                color: #D4AF37 !important;
                border-color: #333 !important;
            }
            .dark-table-container nav[role="navigation"] span {
                color: #F5F5F5 !important;
            }
        </style>
    </head>
    <body class="bg-[#0D0D0D] text-[#F5F5F5]">

    @include('layouts.includes.admin.navigation')

    <div class="p-4 sm:px-6 lg:px-8 mt-14 max-w-screen-2xl mx-auto w-full">
       <div class="mt-14 flex justify-between items-center w-full">
            @include('includes.admin.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
            
            @isset($action)
                <div>
                    {{ $action }}
                </div>
            @endisset
       </div>
       
       <main class="mt-4">
            <div class="bg-[#1A1A1A] border border-gray-800 rounded-2xl p-6 shadow-2xl">
                {{ $slot }}
            </div>
       </main>
    </div>

    @stack('modals')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- Alerta de éxito (cuando ya se eliminó o creó algo) --}}
    @if(session('swal'))
        <script>
            Swal.fire(@json(session('swal')));
        </script>
    @endif

    {{-- SCRIPT DE CONFIRMACIÓN (NUEVO) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Escuchamos el evento click en el documento
            document.addEventListener('submit', function(e) {
                // Si el formulario tiene la clase 'delete-form'
                if (e.target.classList.contains('delete-form')) {
                    e.preventDefault(); // Detenemos el envío
                    
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si confirma, enviamos el formulario físicamente
                            e.target.submit();
                        }
                    });
                }
            });
        });
    </script>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.2.1/dist/flowbite.min.js"></script>
    </body>
</html> 