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
                <div class="flex mb-4">
                    <a href="{{ route('administracion.usuarios.reportPDF') }}"
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out shadow-md">
                        Generar PDF
                    </a>
                </div>

                <!-- Formulario de búsqueda y botones de navegación -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <form action="{{ route('administracion.usuarios.search') }}" method="GET"
                        class="flex flex-col sm:flex-row items-center gap-2 w-full md:w-auto">
                        <input type="text" name="search" placeholder="Buscar por nombre, género o raza"
                            class="px-4 py-2 border rounded-md w-full sm:w-64 shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                            value="{{ request()->search }}" />
                        <button type="submit"
                            class="bg-teal-500 text-white px-6 py-2 rounded-md hover:bg-teal-600 transition duration-300 ease-in-out shadow-md w-full sm:w-auto">
                            Buscar
                        </button>
                    </form>

                    <!-- Botones de Listar y Agregar -->
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('administracion.usuarios.index') }}"
                            class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out shadow-md">
                            Listar usuarios
                        </a>
                        <a href="{{ route('administracion.usuarios.create') }}"
                            class="bg-teal-500 text-white px-6 py-2 rounded-md hover:bg-teal-600 transition duration-300 ease-in-out shadow-md transform hover:scale-105">
                            Agregar usuario
                        </a>
                    </div>
                </div>

                <!-- Mostrar resultados de búsqueda o todos los usuarios -->
                <div class="overflow-x-auto bg-white dark:bg-gray-700 shadow-md rounded-lg">
                    @if(request()->has('search') && !empty(request()->search))
                    <p class="text-gray-600 dark:text-gray-300 p-4">
                        Resultados de la búsqueda para "<strong>{{ request()->search }}</strong>"
                    </p>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-100 dark:bg-gray-600">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                        ID</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                        Nombre</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                        Apellido</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                        Altura</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                        Peso</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                        Genero</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                        Alta</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                        Email</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-200 uppercase">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach($usuarios as $usuario)
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $usuario->id }}</td>
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $usuario->name }}</td>
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $usuario->apellido }}</td>
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $usuario->altura }}</td>
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $usuario->peso }}</td>
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $usuario->genero }}</td>
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                                        {{ $usuario->activo == 1 ? 'Activo' : 'Inactivo' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $usuario->email }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('administracion.usuarios.edit', $usuario->id) }}"
                                                class="bg-green-500 text-white hover:bg-green-600 transition duration-300 ease-in-out text-xs px-3 py-1 rounded-md shadow-md">
                                                Editar
                                            </a>
                                            <form action="{{ route('administracion.usuarios.destroy', $usuario->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 text-white hover:bg-red-600 transition duration-300 ease-in-out text-xs px-3 py-1 rounded-md shadow-md"
                                                    onclick="return confirm('¿Estás seguro de borrar?')">
                                                    Borrar
                                                </button>
                                            </form>
                                            <a href="{{ route('administracion.dietas.dietasemana', $usuario->id) }}"
                                                class="bg-yellow-500 text-white hover:bg-yellow-600 transition duration-300 ease-in-out text-xs px-3 py-1 rounded-md shadow-md">
                                                Dieta
                                            </a>
                                            <a href="{{ route('administracion.rutinas.rutinasemana', $usuario->id) }}"
                                                class="bg-yellow-500 text-white hover:bg-yellow-600 transition duration-300 ease-in-out text-xs px-3 py-1 rounded-md shadow-md">
                                                Rutina
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="p-4">
                        {{ $usuarios->links('pagination::tailwind') }}
                    </div>
                </div>

                <!-- Mensaje si no hay usuarios -->
                @if(count($usuarios) == 0)
                <p class="text-gray-600 dark:text-gray-300 mt-6">
                    No se encontraron usuarios que coincidan con tu búsqueda o no hay usuarios registrados.
                </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection