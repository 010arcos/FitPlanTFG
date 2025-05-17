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
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Gestión de Ejercicios</h1>
                    
                    <div class="flex flex-wrap gap-2 justify-center">
                        <a href="{{ route('administracion.ejercicios.reportPDF') }}" 
                           class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300 ease-in-out shadow-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            PDF
                        </a>
                        <a href="{{ route('administracion.ejercicios.create') }}" 
                           class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 transition duration-300 ease-in-out shadow-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Nuevo Ejercicio
                        </a>
                    </div>
                </div>

                <!-- Formulario de búsqueda -->
                <div class="mb-6">
                    <form action="{{ route('administracion.ejercicios.search') }}" method="GET" 
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
                            <a href="{{ route('administracion.ejercicios.index') }}" 
                               class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out shadow-md flex-grow sm:flex-grow-0 text-center">
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Mostrar resultados de búsqueda o todos los ejercicios -->
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
                                    <th class="hidden md:table-cell px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Descripción
                                    </th>
                                    <th class="hidden sm:table-cell px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Zona
                                    </th>
                                    <th class="hidden sm:table-cell px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach($ejercicios as $ejercicio)
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-3 py-3 text-gray-700 dark:text-gray-300">{{ $ejercicio->id_ejercicio }}</td>
                                    <td class="px-3 py-3 text-gray-700 dark:text-gray-300">{{ $ejercicio->nombre }}</td>
                                    <td class="hidden md:table-cell px-3 py-3 text-gray-700 dark:text-gray-300">
                                        <div class="max-w-xs truncate">{{ $ejercicio->descripcion }}</div>
                                    </td>
                                    <td class="hidden sm:table-cell px-3 py-3 text-gray-700 dark:text-gray-300">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $ejercicio->zona }}
                                        </span>
                                    </td>
                                    <td class="hidden sm:table-cell px-3 py-3 text-gray-700 dark:text-gray-300">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $ejercicio->tipo == 'fuerza' ? 'bg-purple-100 text-purple-800' : 
                                              ($ejercicio->tipo == 'cardio' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ $ejercicio->tipo }}
                                        </span>
                                    </td>
                                    
                                    <!-- Acciones -->
                                    <td class="px-3 py-3">
                                        <!-- Botones en pantallas grandes -->
                                        <div class="hidden sm:flex gap-1">
                                            <a href="{{ route('administracion.ejercicios.edit', $ejercicio->id_ejercicio) }}"
                                               class="bg-blue-500 text-white hover:bg-blue-600 transition duration-300 ease-in-out text-xs px-2 py-1 rounded-md shadow-md">
                                                Editar
                                            </a>
                                            <form action="{{ route('administracion.ejercicios.destroy', $ejercicio->id_ejercicio) }}"
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
                                            <button onclick="toggleDropdown('dropdown-{{ $ejercicio->id_ejercicio }}')" class="bg-gray-200 p-2 rounded-md w-full flex justify-between items-center">
                                                <span class="text-sm font-medium">Acciones</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                            <div id="dropdown-{{ $ejercicio->id_ejercicio }}" class="hidden mt-1 bg-white border rounded-md shadow-lg z-10 w-full">
                                                <div class="py-1 grid grid-cols-1 gap-1 p-1">
                                                    <!-- Información adicional en móviles -->
                                                    <div class="text-xs text-gray-500 px-2 py-1 bg-gray-50 rounded">
                                                        <div><strong>Zona:</strong> {{ $ejercicio->zona }}</div>
                                                        <div><strong>Tipo:</strong> {{ $ejercicio->tipo }}</div>
                                                    </div>
                                                    <a href="{{ route('administracion.ejercicios.edit', $ejercicio->id_ejercicio) }}" 
                                                       class="bg-blue-500 text-white hover:bg-blue-600 transition duration-300 ease-in-out text-xs px-2 py-1 rounded-md shadow-md text-center">
                                                        Editar
                                                    </a>
                                                    <form action="{{ route('administracion.ejercicios.destroy', $ejercicio->id_ejercicio) }}" 
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
                        {{ $ejercicios->links('pagination::tailwind') }}
                    </div>
                </div>
                <!-- Mensaje si no hay ejercicios -->
                @if(count($ejercicios) == 0)
                <p class="text-gray-600 dark:text-gray-300 mt-6">
                    No se encontraron ejercicios que coincidan con tu búsqueda o no hay ejercicios registrados.
                </p>
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