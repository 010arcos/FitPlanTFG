<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('administracion') }}" class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="block h-12 w-auto" />
                    <span class="text-white font-bold ml-2">FitPlan</span>
                </a>
            </div>

            <!-- Links in primary menu (including usuarios link and Videojuegos link) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- usuarios link -->
                <x-nav-link :href="route('administracion.usuarios.index')"
                    :active="request()->routeIs('administracion.usuarios.index')"
                    class="text-white hover:text-white hover:scale-105 transition-transform duration-200 hover:border-b-2 hover:border-purple-500">
                    {{ __('Usuarios') }}
                </x-nav-link>
                <x-nav-link :href="route('administracion.dietas.index')"
                    :active="request()->routeIs('administracion.dietas.index')"
                    class="text-white hover:text-white hover:scale-105 transition-transform duration-200 hover:border-b-2 hover:border-purple-500">
                    {{ __('Dietas') }}
                </x-nav-link>

                <x-nav-link :href="route('administracion.comidas.index')"
                    :active="request()->routeIs('administracion.comidas.index')"
                    class="text-white hover:text-white hover:scale-105 transition-transform duration-200 hover:border-b-2 hover:border-purple-500">
                    {{ __('Comidas') }}
                </x-nav-link>


                <x-nav-link :href="route('administracion.ejercicios.index')"
                    :active="request()->routeIs('administracion.ejercicios.index')"
                    class="text-white hover:text-white hover:scale-105 transition-transform duration-200 hover:border-b-2 hover:border-purple-500">
                    {{ __('Ejercicios') }}
                </x-nav-link>

                <x-nav-link :href="route('administracion.rutinas.index')"
                    :active="request()->routeIs('administracion.rutinas.index')"
                    class="text-white hover:text-white hover:scale-105 transition-transform duration-200 hover:border-b-2 hover:border-purple-500">
                    {{ __('Rutinas') }}
                </x-nav-link>





                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-900 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}"
                            class="bg-transparent hover:bg-[#111827] transition-all duration-200 rounded-md">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="block w-full text-left text-gray-700 hover:text-grey px-4 py-2">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger for small screens -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4 text-center">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-gray-300 hover:text-white hover:bg-gray-700 hover:scale-105 transition-transform duration-200 bg-transparent focus:bg-transparent active:bg-transparent flex items-center justify-center border-l-0 hover:border-l-0">
                        <!-- Ícono de Log Out -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </x-responsive-nav-link>
                </form>
            </div>

            <div class="mt-3 space-y-1">
                <!-- usuarios link for small screens -->
                <x-responsive-nav-link :href="route('administracion.usuarios.index')"
                    :active="request()->routeIs('administracion.usuarios.index')"
                    class="text-gray-300 text-center hover:text-white hover:bg-gray-700 hover:scale-105 transition-transform duration-200 bg-transparent focus:bg-transparent active:bg-transparent border-l-0 hover:border-l-0">
                    {{ __('Usuarios') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('administracion.dietas.index')"
                    :active="request()->routeIs('administracion.dietas.index')"
                    class="text-gray-300 text-center hover:text-white hover:bg-gray-700 hover:scale-105 transition-transform duration-200 bg-transparent focus:bg-transparent active:bg-transparent border-l-0 hover:border-l-0">
                    {{ __('Dietas') }}
                </x-responsive-nav-link>



                <x-responsive-nav-link :href="route('administracion.comidas.index')"
                    :active="request()->routeIs('administracion.comidas.index')"
                    class="text-gray-300 text-center hover:text-white hover:bg-gray-700 hover:scale-105 transition-transform duration-200 bg-transparent focus:bg-transparent active:bg-transparent border-l-0 hover:border-l-0">
                    {{ __('Comidas') }}
                </x-responsive-nav-link>



                <x-responsive-nav-link :href="route('administracion.ejercicios.index')"
                    :active="request()->routeIs('administracion.ejercicios.index')"
                    class="text-gray-300 text-center hover:text-white hover:bg-gray-700 hover:scale-105 transition-transform duration-200 bg-transparent focus:bg-transparent active:bg-transparent border-l-0 hover:border-l-0">
                    {{ __('Ejercicios') }}
                </x-responsive-nav-link>


                <x-responsive-nav-link :href="route('administracion.rutinas.index')"
                    :active="request()->routeIs('administracion.rutinas.index')"
                    class="text-gray-300 text-center hover:text-white hover:bg-gray-700 hover:scale-105 transition-transform duration-200 bg-transparent focus:bg-transparent active:bg-transparent border-l-0 hover:border-l-0">
                    {{ __('Rutinas') }}
                </x-responsive-nav-link>


            </div>
        </div>
    </div>
</nav>