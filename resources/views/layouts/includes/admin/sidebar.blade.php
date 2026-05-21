<aside id="logo-sidebar" 
       :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
       class="fixed top-0 left-0 z-50 w-64 h-screen transition-transform -translate-x-full bg-[#111] border-r border-gray-800 sm:translate-x-0" 
       aria-label="Sidebar">
   
   <div class="h-full px-3 pb-4 overflow-y-auto bg-[#111]">
      
      <!-- Logo top -->
      <div class="flex items-center justify-center p-6 mb-2 border-b border-gray-800">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold tracking-tighter">
            <span class="text-white">AURA</span>
            <span class="gold-text">AESTHETICS</span>
        </a>
      </div>

      <ul class="space-y-2 font-medium mt-4">
         
         <li>
            <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-[#222] to-[#111] text-[#D4AF37] border-l-4 border-[#D4AF37] shadow-lg shadow-black/20' : 'text-gray-400 hover:bg-[#222] hover:text-[#D4AF37]' }} transition-all group">
               <i class="fa-solid fa-chart-pie w-6 text-center text-lg {{ request()->routeIs('dashboard') ? 'text-[#D4AF37]' : 'text-gray-500 group-hover:text-[#D4AF37]' }} transition duration-75"></i>
               <span class="ms-3 font-bold">Panel de Control</span>
            </a>
         </li>

         @hasanyrole('Administrador|Estilista|Barbero|Mixto')
         <li class="pt-6 pb-2">
            <div class="text-xs font-bold text-gray-500 uppercase tracking-widest px-2">
                Gestión de Estética
            </div>
         </li>
         
         <li>
            <a href="{{ route('admin.services.index') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('admin.services.*') ? 'bg-gradient-to-r from-[#222] to-[#111] text-[#D4AF37] border-l-4 border-[#D4AF37] shadow-lg shadow-black/20' : 'text-gray-400 hover:bg-[#222] hover:text-[#D4AF37]' }} transition-all group">
               <i class="fa-solid fa-scissors w-6 text-center text-lg {{ request()->routeIs('admin.services.*') ? 'text-[#D4AF37]' : 'text-gray-500 group-hover:text-[#D4AF37]' }} transition duration-75"></i>
               <span class="flex-1 ms-3 whitespace-nowrap font-medium">Servicios</span>
            </a>
         </li>
         
         <li>
            <a href="{{ route('admin.specialists.index') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('admin.specialists.*') ? 'bg-gradient-to-r from-[#222] to-[#111] text-[#D4AF37] border-l-4 border-[#D4AF37] shadow-lg shadow-black/20' : 'text-gray-400 hover:bg-[#222] hover:text-[#D4AF37]' }} transition-all group">
               <i class="fa-solid fa-user-tie w-6 text-center text-lg {{ request()->routeIs('admin.specialists.*') ? 'text-[#D4AF37]' : 'text-gray-500 group-hover:text-[#D4AF37]' }} transition duration-75"></i>
               <span class="flex-1 ms-3 whitespace-nowrap font-medium">Especialistas</span>
            </a>
         </li>
         
         <li>
            <a href="{{ route('admin.appointments.index') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('admin.appointments.*') ? 'bg-gradient-to-r from-[#222] to-[#111] text-[#D4AF37] border-l-4 border-[#D4AF37] shadow-lg shadow-black/20' : 'text-gray-400 hover:bg-[#222] hover:text-[#D4AF37]' }} transition-all group">
               <i class="fa-solid fa-calendar-check w-6 text-center text-lg {{ request()->routeIs('admin.appointments.*') ? 'text-[#D4AF37]' : 'text-gray-500 group-hover:text-[#D4AF37]' }} transition duration-75"></i>
               <span class="flex-1 ms-3 whitespace-nowrap font-medium">Citas</span>
            </a>
         </li>
         @endhasanyrole
         
         @role('Administrador')
         <li class="pt-6 pb-2">
            <div class="text-xs font-bold text-gray-500 uppercase tracking-widest px-2">
                Administración
            </div>
         </li>
         
         <li>
            <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-[#222] to-[#111] text-[#D4AF37] border-l-4 border-[#D4AF37] shadow-lg shadow-black/20' : 'text-gray-400 hover:bg-[#222] hover:text-[#D4AF37]' }} transition-all group">
               <i class="fa-solid fa-users w-6 text-center text-lg {{ request()->routeIs('admin.users.*') ? 'text-[#D4AF37]' : 'text-gray-500 group-hover:text-[#D4AF37]' }} transition duration-75"></i>
               <span class="flex-1 ms-3 whitespace-nowrap font-medium">Usuarios y Staff</span>
            </a>
         </li>
         @endrole

      </ul>
   </div>
</aside>
