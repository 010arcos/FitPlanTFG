<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Logo y texto -->
            <div class="flex items-center">
                <a href="{{ route('usuario.index') }}" class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="block h-12 w-auto" />
                    <span class="text-white font-bold ml-2">FitPlan</span>
                </a>
            </div>

            <!-- Links en menú principal -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (request()->routeIs('usuario.index'))
                    <!-- Mostrar solo en usuario.index -->
                    <div class="spotify-container">
                        <a href="https://open.spotify.com/playlist/3m3x3Bo5Zd04dDTI1RGrBl?si=8242c8dfefca42bf" target="_blank" class="spotify-link">
                            <i class="fab fa-spotify"></i>
                            <span>Spotify</span>
                        </a>
                    </div>
                @else
                    <!-- Mostrar en todas las demás rutas -->
                    <div class="space-x-4">
                        <x-nav-link :href="route('usuario.index')" :active="request()->routeIs('usuario.index')" class="text-white hover:text-white hover:scale-105 transition-transform duration-200 hover:border-b-2 hover:border-purple-500">
                            {{ __('Inicio') }}
                        </x-nav-link>
                        <x-nav-link :href="route('usuario.rutina')" :active="request()->routeIs('usuario.rutina')" class="text-white hover:text-white hover:scale-105 transition-transform duration-200 hover:border-b-2 hover:border-purple-500">
                            {{ __('Rutina') }}
                        </x-nav-link>
                        <x-nav-link :href="route('usuario.dieta')" :active="request()->routeIs('usuario.dieta')" class="text-white hover:text-white hover:scale-105 transition-transform duration-200 hover:border-b-2 hover:border-purple-500">
                            {{ __('Dieta') }}
                        </x-nav-link>
                        <x-nav-link :href="route('usuario.progreso')" :active="request()->routeIs('usuario.progreso')" class="text-white hover:text-white hover:scale-105 transition-transform duration-200 hover:border-b-2 hover:border-purple-500">
                            {{ __('Mi progreso') }}
                        </x-nav-link>
                    </div>
                @endif

                <!-- User Menu -->
                <div class="ml-4 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-white hover:text-gray-300 focus:outline-none focus:text-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" class="bg-transparent hover:bg-[#111827] transition-all duration-200 rounded-md">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full text-left text-gray-700 hover:text-grey px-4 py-2">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger for small screens -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4 text-center">
                <div class="font-bold text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                @if (request()->routeIs('usuario.index'))
                    <!-- Mostrar solo en usuario.index -->
                    <x-responsive-nav-link href="https://open.spotify.com/playlist/3m3x3Bo5Zd04dDTI1RGrBl?si=8242c8dfefca42bf" target="_blank" class="text-gray-300 hover:text-white hover:scale-105 transition-transform duration-200">
                        <i class="fab fa-spotify"></i>
                        <span>Spotify</span>
                    </x-responsive-nav-link>
                @else
                    <!-- Mostrar en todas las demás rutas -->
                    <x-responsive-nav-link :href="route('usuario.index')" :active="request()->routeIs('usuario.index')" class="text-gray-300 hover:text-white hover:scale-105 transition-transform duration-200">
                        {{ __('Inicio') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('usuario.rutina')" :active="request()->routeIs('usuario.rutina')" class="text-gray-300 hover:text-white hover:scale-105 transition-transform duration-200">
                        {{ __('Rutina') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('usuario.dieta')" :active="request()->routeIs('usuario.dieta')" class="text-gray-300 hover:text-white hover:scale-105 transition-transform duration-200">
                        {{ __('Dieta') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('usuario.progreso')" :active="request()->routeIs('usuario.progreso')" class="text-gray-300 hover:text-white hover:scale-105 transition-transform duration-200">
                        {{ __('Mi progreso') }}
                    </x-responsive-nav-link>
                @endif
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-300 hover:text-white hover:scale-105 transition-transform duration-200">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>