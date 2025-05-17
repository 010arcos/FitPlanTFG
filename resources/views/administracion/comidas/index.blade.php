@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 md:p-6 text-gray-900 dark:text-gray-100">
                <!-- Mostrar mensaje si existe -->
                @if(Session::has('Mensaje'))
                <div class="flex justify-center mb-6">
                    <div class="bg-teal-100 border border-teal-400 text-teal-700 px-6 py-3 rounded-lg shadow-md max-w-lg text-center">
                        {{ Session::get('Mensaje') }}
                    </div>
                </div>
                @endif

                <!-- Cabecera con título y botones principales -->
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Gestión de Comidas</h1>
                    
                    <div class="flex flex-wrap gap-2 justify-center">
                        <a href="{{ route('administracion.comidas.reportPDF') }}"
                           class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300 ease-in-out shadow-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            PDF
                        </a>
                        <a href="{{ route('administracion.comidas.create') }}"
                           class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 transition duration-300 ease-in-out shadow-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Nueva Comida
                        </a>
                    </div>
                </div>

                <!-- Formulario de búsqueda -->
                <div class="mb-6">
                    <form action="{{ route('administracion.comidas.search') }}" method="GET"
                          class="flex flex-col sm:flex-row items-center gap-2">
                        <div class="relative flex-grow">
                            <input type="text" name="search" placeholder="  Buscar por id, nombre o descripción"
                                   class="px-4 py-2 pl-10 border rounded-md w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                   value="{{ request()->search }}" />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex gap-2 w-full sm:w-auto">
                            <button type="submit"
                                    class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 transition duration-300 ease-in-out shadow-md flex-grow sm:flex-grow-0">
                                Buscar
                            </button>
                            <a href="{{ route('administracion.comidas.index') }}"
                               class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out shadow-md flex-grow sm:flex-grow-0 text-center">
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Mostrar resultados de búsqueda o todos los comidas -->
                <div class="overflow-x-auto bg-white dark:bg-gray-700 shadow-md rounded-lg">
                    @if(request()->has('search') && !empty(request()->search))
                    <p class="text-gray-600 dark:text-gray-300 p-4">
                        Resultados para "<strong>{{ request()->search }}</strong>"
                    </p>
                    @endif
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-100 dark:bg-gray-600">
                                <tr>
                                    <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th class="hidden lg:table-cell px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Ingredientes
                                    </th>
                                    <th class="hidden md:table-cell px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Calorías
                                    </th>
                                    <th class="hidden lg:table-cell px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Macros
                                    </th>
                                    <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach($comidas as $comida)
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-3 py-3 text-gray-700 dark:text-gray-300">{{ $comida->id_comida }}</td>
                                    <td class="px-3 py-3 text-gray-700 dark:text-gray-300">{{ $comida->nombre }}</td>
                                    
                                    @php
                                    $ingredientes = json_decode($comida->alimentos, true);
                                    @endphp
                                    
                                    <td class="hidden lg:table-cell px-3 py-3 text-gray-700 dark:text-gray-300">
                                        @if(isset($ingredientes['ingredientes']))
                                        <ul class="list-disc list-inside text-xs">
                                            @foreach($ingredientes['ingredientes'] as $item)
                                            <li><span class="font-medium">{{ $item['nombre'] }}:</span> {{ $item['cantidad'] }}</li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <span class="text-gray-500 italic">No disponible</span>
                                        @endif
                                    </td>
                                    
                                    <td class="hidden md:table-cell px-3 py-3 text-gray-700 dark:text-gray-300">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                            {{ $comida->calorias }} kcal
                                        </span>
                                    </td>
                                    
                                    @php
                                    $macros = json_decode($comida->macros, true);
                                    @endphp
                                    
                                    <td class="hidden lg:table-cell px-3 py-3 text-gray-700 dark:text-gray-300">
                                        @if($macros)
                                        <ul class="text-xs space-y-1">
                                            <li class="flex items-center">
                                                <span class="w-3 h-3 bg-blue-500 rounded-full mr-1"></span>
                                                <span class="font-medium">P:</span> {{ $macros['proteinas'] }}g
                                            </li>
                                            <li class="flex items-center">
                                                <span class="w-3 h-3 bg-green-500 rounded-full mr-1"></span>
                                                <span class="font-medium">C:</span> {{ $macros['carbohidratos'] }}g
                                            </li>
                                            <li class="flex items-center">
                                                <span class="w-3 h-3 bg-yellow-500 rounded-full mr-1"></span>
                                                <span class="font-medium">G:</span> {{ $macros['grasas'] }}g
                                            </li>
                                        </ul>
                                        @else
                                        <span class="text-gray-500 italic">No disponible</span>
                                        @endif
                                    </td>
                                    
                                    <!-- Acciones -->
                                    <td class="px-3 py-3">
                                        <!-- Botones en pantallas grandes -->
                                        <div class="hidden sm:flex gap-1">
                                            <a href="{{ route('administracion.comidas.edit', $comida->id_comida) }}"
                                               class="bg-blue-500 text-white hover:bg-blue-600 transition duration-300 ease-in-out text-xs px-2 py-1 rounded-md shadow-md">
                                                Editar
                                            </a>
                                            <form action="{{ route('administracion.comidas.destroy', $comida->id_comida) }}"
                                                  method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-500 text-white hover:bg-red-600 transition duration-300 ease-in-out text-xs px-2 py-1 rounded-md shadow-md"
                                                        onclick="return confirm('¿Estás seguro de borrar?')">
                                                    Borrar
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <!-- Menú desplegable para móviles -->
                                        <div class="sm:hidden">
                                            <button onclick="toggleDropdown('dropdown-{{ $comida->id_comida }}')" class="bg-gray-200 p-2 rounded-md w-full flex justify-between items-center">
                                                <span class="text-sm font-medium">Acciones</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                            <div id="dropdown-{{ $comida->id_comida }}" class="hidden mt-1 bg-white border rounded-md shadow-lg z-10 w-full">
                                                <div class="py-1 grid grid-cols-1 gap-1 p-1">
                                                    <!-- Información adicional en móviles -->
                                                    <div class="text-xs text-gray-500 px-2 py-1 bg-gray-50 rounded">
                                                        <div><strong>Calorías:</strong> {{ $comida->calorias }} kcal</div>
                                                        @if($macros)
                                                        <div><strong>Macros:</strong> P:{{ $macros['proteinas'] }}g | C:{{ $macros['carbohidratos'] }}g | G:{{ $macros['grasas'] }}g</div>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('administracion.comidas.edit', $comida->id_comida) }}" 
                                                       class="bg-blue-500 text-white hover:bg-blue-600 transition duration-300 ease-in-out text-xs px-2 py-1 rounded-md shadow-md text-center">
                                                        Editar
                                                    </a>
                                                    <form action="{{ route('administracion.comidas.destroy', $comida->id_comida) }}" 
                                                          method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="bg-red-500 text-white hover:bg-red-600 transition duration-300 ease-in-out text-xs px-2 py-1 rounded-md shadow-md w-full"
                                                                onclick="return confirm('¿Estás seguro de borrar?')">
                                                            Borrar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Paginación -->
                    <div class="p-4">
                        {{ $comidas->links('pagination::tailwind') }}
                    </div>
                </div>

                <!-- Mensaje si no hay comidas -->
                @if(count($comidas) == 0)
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-8 mt-6 text-center rounded-lg border border-yellow-200 dark:border-yellow-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-yellow-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-gray-600 dark:text-gray-300 mt-6">No se encontraron comidas que coincidan con tu búsqueda o no hay comidas registrados.</p>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

<!-- Script para manejar los menús desplegables en móviles -->
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        if (dropdown.classList.contains('hidden')) {
            // Cerrar todos los dropdowns primero
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (el.id !== id) {
                    el.classList.add('hidden');
                }
            });
            // Abrir el seleccionado
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    }
    
    // Cerrar dropdowns cuando se hace clic fuera de ellos
    document.addEventListener('click', function(event) {
        if (!event.target.closest('button') || !event.target.closest('button').onclick.toString().includes('toggleDropdown')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });
</script>
@endsection