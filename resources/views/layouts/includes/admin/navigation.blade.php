<nav class="fixed top-0 z-50 w-full bg-[#111] border-b border-gray-800" x-data="{ mobileMenuOpen: false }">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <!-- Mobile menu button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="sm:hidden text-gray-400 bg-transparent hover:bg-gray-900 focus:ring-4 focus:ring-[#D4AF37] font-medium leading-5 rounded-base text-sm p-2 focus:outline-none transition-all">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <a href="/" class="flex ms-2 md:me-10">
            <div class="text-xl font-bold tracking-tighter">
                <span class="text-white">AURA</span>
                <span class="gold-text">AESTHETICS</span>
            </div>
        </a>

        <!-- Desktop Navigation Links -->
        <div class="hidden sm:flex sm:items-center sm:space-x-8">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-[#D4AF37] text-white font-bold' : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-800' }} text-sm leading-5 transition duration-150 ease-in-out">
                Dashboard
            </a>

            <!-- Gestión de Estética Dropdown -->
            <div class="relative">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-800 text-sm leading-5 transition duration-150 ease-in-out">
                            Gestión de Estética
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="#">
                            <i class="fa-solid fa-scissors w-5 text-center mr-2 text-[#D4AF37]"></i> Servicios
                        </x-dropdown-link>
                        <x-dropdown-link href="#">
                            <i class="fa-solid fa-user-tie w-5 text-center mr-2 text-[#D4AF37]"></i> Especialistas
                        </x-dropdown-link>
                        <x-dropdown-link href="#">
                            <i class="fa-solid fa-calendar-check w-5 text-center mr-2 text-[#D4AF37]"></i> Citas
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Administración Dropdown -->
            <div class="relative">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.*') ? 'border-[#D4AF37] text-white font-bold' : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-800' }} text-sm leading-5 transition duration-150 ease-in-out">
                            Administración
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('admin.users.index') }}">
                            <i class="fa-solid fa-users w-5 text-center mr-2 text-[#D4AF37]"></i> Usuarios
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
      </div>

       <!-- Settings Dropdown -->
        <div class="ms-3 relative">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-[#D4AF37] transition">
                            <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-400 bg-[#111] hover:text-[#D4AF37] focus:outline-none transition ease-in-out duration-150">
                                {{ Auth::user()->name }}

                                <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    @endif
                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-500">
                        {{ __('Manage Account') }}
                    </div>

                    <x-dropdown-link href="{{ route('profile.show') }}" class="hover:bg-gray-800 hover:text-[#D4AF37]">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <div class="border-t border-gray-800"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-dropdown-link href="{{ route('logout') }}"
                                 @click.prevent="$root.submit();" class="hover:bg-red-600 hover:text-white">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{'block': mobileMenuOpen, 'hidden': ! mobileMenuOpen}" class="sm:hidden border-t border-gray-800 bg-[#0D0D0D]">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            Dashboard
        </x-responsive-nav-link>

        <div class="block px-4 py-2 text-xs text-gray-500 font-semibold uppercase mt-4">
            Gestión de Estética
        </div>
        <x-responsive-nav-link href="#">
            <i class="fa-solid fa-scissors w-5 text-center mr-2"></i> Servicios
        </x-responsive-nav-link>
        <x-responsive-nav-link href="#">
            <i class="fa-solid fa-user-tie w-5 text-center mr-2"></i> Especialistas
        </x-responsive-nav-link>
        <x-responsive-nav-link href="#">
            <i class="fa-solid fa-calendar-check w-5 text-center mr-2"></i> Citas
        </x-responsive-nav-link>

        <div class="block px-4 py-2 text-xs text-gray-500 font-semibold uppercase mt-4">
            Administración
        </div>
        <x-responsive-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
            <i class="fa-solid fa-users w-5 text-center mr-2"></i> Usuarios
        </x-responsive-nav-link>
    </div>
  </div>
</nav>