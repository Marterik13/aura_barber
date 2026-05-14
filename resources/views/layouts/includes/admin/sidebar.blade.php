@php
   $links = [
      [
         'name' => 'Dashboard',
         'icon' => 'fa-solid fa-gauge',
         'href' => route('dashboard'),
         'active' => request()->routeIs('dashboard')
      ],
      [
         'header' => 'Gestión de Estética',
      ],
      [
         'name' => 'Servicios',
         'icon' => 'fa-solid fa-scissors',
         'href' => '#',
         'active' => false,
      ],
      [
         'name' => 'Especialistas',
         'icon' => 'fa-solid fa-user-tie',
         'href' => '#',
         'active' => false,
      ],
      [
         'name' => 'Citas',
         'icon' => 'fa-solid fa-calendar-check',
         'href' => '#',
         'active' => false,
      ],
      [
         'header' => 'Administración',
      ],
      [
         'name' => 'Usuarios',
         'icon' => 'fa-solid fa-users',
         'href' => '#',
         'active' => false,
      ],
   ];
@endphp

<aside id="top-bar-sidebar" class="fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-[#111] border-e border-gray-800">
      <a href="/" class="flex flex-col items-center mb-10 mt-4">
         <div class="text-2xl font-bold tracking-tighter">
             <span class="text-white">AURA</span>
             <span class="gold-text">AESTHETICS</span>
         </div>
      </a>
      <ul class="space-y-2 font-medium">
         @foreach ($links as $link)
         <li>
            @isset($link['header'])
               <div class="px-2 py-4 text-xs font-semibold text-gray-500 uppercase tracking-widest">
                  {{ $link['header'] }}
               </div>
            @else
               <a href="{{ $link['href'] }}" class="flex items-center px-4 py-3 text-gray-400 rounded-xl hover:bg-gray-900 hover:text-[#D4AF37] transition-all group {{ $link['active'] ? 'bg-gray-900 text-[#D4AF37] font-bold border-l-4 border-[#D4AF37]' : '' }}">
                  <span class="w-6 h-6 inline-flex items-center justify-center">
                     <i class="{{ $link['icon'] }}"></i>
                  </span>
                  <span class="flex-1 ms-3 whitespace-nowrap">{{ $link['name'] }}</span>
               </a>
            @endisset
         </li>
         @endforeach
      </ul>
   </div>
</aside>