@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Encabezado con información del usuario -->
        <div class="flex items-center justify-between mb-8 border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold">Asignar Rutinas por Día</h1>
                <p class="text-gray-600 mt-1">Usuario: <span class="font-medium text-teal-600">{{ $usuario->name }} {{
                        $usuario->apellido }}</span></p>
            </div>
            <div class="text-right">
                <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    {{ count($rutinasAsignadas) }} rutinas asignadas
                </span>
            </div>
        </div>

        <form action="{{ route('administracion.rutinas.guardar.usuario', $usuario->id) }}" method="POST">
            @csrf
            <!-- Formulario de selección por día -->
            <div class="space-y-6">
                <!-- Lunes -->
                <div class="form-group">
                    <label for="rutina-lunes" class="block text-sm font-medium text-gray-700 mb-2">
                        <span
                            class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded mr-2">Lunes</span>
                        Rutina para el lunes
                    </label>
                    <select id="rutina-lunes" name="rutina_lunes"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                        <option value="">No seleccionar</option>
                        @foreach($rutinasPorDia['lunes'] as $rutina)
                        <option value="{{ $rutina->id_rutina }}" {{ in_array($rutina->id_rutina, $rutinasAsignadas) ?
                            'selected' : '' }}>
                            {{ $rutina->nombre }} ({{ $rutina->ejercicios->count() }} ejercicios)
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Martes -->
                <div class="form-group">
                    <label for="rutina-martes" class="block text-sm font-medium text-gray-700 mb-2">
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded mr-2">Martes</span>
                        Rutina para el martes
                    </label>
                    <select id="rutina-martes" name="rutina_martes"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                        <option value="">Selecciona una rutina</option>
                        @foreach($rutinasPorDia['martes'] as $rutina)
                        <option value="{{ $rutina->id_rutina }}" {{ in_array($rutina->id_rutina, $rutinasAsignadas) ?
                            'selected' : '' }}>
                            {{ $rutina->nombre }} ({{ $rutina->ejercicios->count() }} ejercicios)
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Miércoles -->
                <div class="form-group">
                    <label for="rutina-miercoles" class="block text-sm font-medium text-gray-700 mb-2">
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded mr-2">Miércoles</span>
                        Rutina para el miércoles
                    </label>
                    <select id="rutina-miercoles" name="rutina_miercoles"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                        <option value="">Selecciona una rutina</option>
                        @foreach($rutinasPorDia['miercoles'] as $rutina)
                        <option value="{{ $rutina->id_rutina }}" {{ in_array($rutina->id_rutina, $rutinasAsignadas) ?
                            'selected' : '' }}>
                            {{ $rutina->nombre }} ({{ $rutina->ejercicios->count() }} ejercicios)
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jueves -->
                <div class="form-group">
                    <label for="rutina-jueves" class="block text-sm font-medium text-gray-700 mb-2">
                        <span
                            class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded mr-2">Jueves</span>
                        Rutina para el jueves
                    </label>
                    <select id="rutina-jueves" name="rutina_jueves"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                        <option value="">Selecciona una rutina</option>
                        @foreach($rutinasPorDia['jueves'] as $rutina)
                        <option value="{{ $rutina->id_rutina }}" {{ in_array($rutina->id_rutina, $rutinasAsignadas) ?
                            'selected' : '' }}>
                            {{ $rutina->nombre }} ({{ $rutina->ejercicios->count() }} ejercicios)
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Viernes -->
                <div class="form-group">
                    <label for="rutina-viernes" class="block text-sm font-medium text-gray-700 mb-2">
                        <span
                            class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded mr-2">Viernes</span>
                        Rutina para el viernes
                    </label>
                    <select id="rutina-viernes" name="rutina_viernes"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                        <option value="">Selecciona una rutina</option>
                        @foreach($rutinasPorDia['viernes'] as $rutina)
                        <option value="{{ $rutina->id_rutina }}" {{ in_array($rutina->id_rutina, $rutinasAsignadas) ?
                            'selected' : '' }}>
                            {{ $rutina->nombre }} ({{ $rutina->ejercicios->count() }} ejercicios)
                        </option>
                        @endforeach
                    </select>
                </div>

               
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col md:flex-row justify-between gap-4 mt-8 pt-4 border-t">
                <div class="flex gap-2">
                    <button type="submit"
                        class="bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Guardar Plan Semanal
                    </button>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('administracion.usuarios.index', $usuario->id) }}"
                        class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Volver al Perfil
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection