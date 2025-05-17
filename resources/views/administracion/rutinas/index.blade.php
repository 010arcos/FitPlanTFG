@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">




                <!-- Mostrar mensaje si existe -->
                @if(Session::has('Mensaje'))
                <div class="flex justify-center mb-6">
                    <div
                        class="bg-teal-100 border border-teal-400 text-teal-700 px-6 py-3 rounded-lg shadow-md max-w-lg text-center">
                        {{ Session::get('Mensaje') }}
                    </div>
                </div>
                @endif




                <!-- Botones de PDF -->
                <div class="flex space-x-4">
                    <a href="{{ route('administracion.rutinas.reportPDF') }}"
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out shadow-md mt-2 mb-2">
                        Generar PDF
                    </a>

                </div>




                <br>

                <!-- Formulario de búsqueda y botones de navegación -->
                <div class="flex justify-between items-center mb-6">
                    <form action="{{ route('administracion.rutinas.search') }}" method="GET"
                        class="flex items-center space-x-4">
                        <!--action="{{ url('rutinas/search') }}" --->
                        <input type="text" name="search" placeholder="Buscar por id, nombre o descripcion"
                            class="px-4 py-2 border rounded-md w-64 shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                            value="{{ request()->search }}" />
                        <button type="submit"
                            class="bg-teal-500 text-white px-6 py-2 rounded-md hover:bg-teal-600 transition duration-300 ease-in-out shadow-md">
                            Buscar
                        </button>
                    </form>

                    <!-- Botones de Listar y Agregar -->
                    <div class="flex space-x-4">
                        <a href="{{ route('administracion.rutinas.index') }}"
                            class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out shadow-md">
                            Listar rutinas
                        </a>
                        <a href="{{ route('administracion.rutinas.create') }}"
                            class="bg-teal-500 text-white px-6 py-2 rounded-md hover:bg-teal-600 transition duration-300 ease-in-out shadow-md transform hover:scale-105">
                            Agregar rutina
                        </a>
                    </div>
                </div>

                <!-- Mostrar resultados de búsqueda o todos los rutinas -->
                <div class="overflow-x-auto bg-white dark:bg-gray-700 shadow-md rounded-lg">
                    @if(request()->has('search') && !empty(request()->search))
                    <p class="text-gray-600 dark:text-gray-300 p-4">Resultados de la búsqueda para "<strong>{{
                            request()->search }}</strong>"</p>
                    @endif

                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100 dark:bg-gray-600">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                    ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                    Nombre</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                    Descripcion</th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                    Dia</th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                    Fecha Inicio</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                    Fecha Fin</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($rutinas as $rutina)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $rutina->id_rutina }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $rutina->nombre }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $rutina->descripcion }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $rutina->dia }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 w-[150px]">{{
                                    $rutina->fecha_inicio
                                    }}</td> <!-- Aumenté el ancho de esta celda -->
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300 w-[150px]">{{ $rutina->fecha_fin
                                    }}
                                </td> <!-- Aumenté el ancho de esta celda -->







                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('administracion.rutinas.edit', $rutina->id_rutina) }}"
                                            class="bg-green-500 text-white hover:bg-green-600 transition duration-300 ease-in-out text-sm px-4 py-2 rounded-md shadow-md">
                                            Editar
                                        </a>
                                        <form action="{{ route('administracion.rutinas.destroy', $rutina->id_rutina) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white hover:bg-red-600 transition duration-300 ease-in-out text-sm px-4 py-2 rounded-md shadow-md"
                                                onclick="return confirm('¿Estás seguro de borrar?')">
                                                Borrar
                                            </button>
                                        </form>

                                        <a href="{{ route('administracion.rutinas.asignar.ejercicio', $rutina->id_rutina) }}"
                                            class="bg-yellow-500 text-white hover:bg-yellow-600 transition duration-300 ease-in-out text-sm px-3 py-2 rounded-md shadow-md">
                                            Ejercicios
                                        </a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="p-4">
                        {{ $rutinas->links('pagination::tailwind') }}
                    </div>
                </div>

                <!-- Mensaje si no hay rutinas -->
                @if(count($rutinas) == 0)
                <p class="text-gray-600 dark:text-gray-300 mt-6">No se encontraron rutinas que coincidan con tu búsqueda
                    o no hay rutinas registrados.</p>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection