@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Asignar Ejercicios a Rutina: {{ $rutina->nombre }}</h2>

    <form action="{{ route('administracion.rutinas.guardar.ejercicio', $rutina->id_rutina) }}" method="POST"
        id="ejercicios-form">
        @csrf

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="mb-4">
                <p class="text-gray-700 mb-2"><span class="font-semibold">Descripción:</span> {{ $rutina->descripcion }}
                </p>
                <p class="text-gray-700 mb-2"><span class="font-semibold">Fechas:</span> {{ date('d/m/Y',
                    strtotime($rutina->fecha_inicio)) }} - {{ date('d/m/Y', strtotime($rutina->fecha_fin)) }}</p>

                <!-- Selector de día para la rutina -->
                <div class="mt-4">
                    <label for="dia_rutina" class="block text-sm font-medium text-gray-700 mb-2">Día de la
                        rutina (cambiar):</label>
                    <select id="dia_rutina" name="dia_rutina"
                        class="w-full md:w-64 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @foreach($diasSemana as $dia)
                        <option value="{{ $dia }}" {{ $rutina->dia == $dia ? 'selected' : '' }}>
                            {{ ucfirst($dia) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Contador de ejercicios seleccionados -->
            <div class="mb-4">
                <p class="text-gray-700">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        {{ $ejerciciosAsignados->count() }} ejercicios asignados
                    </span>
                </p>
            </div>

            <!-- Acordeón para zonas musculares -->
            <div class="mb-4 space-y-3">
                @foreach($ejerciciosPorZona as $zona => $ejercicios)
                <div class="border border-gray-200 rounded-lg overflow-hidden zona-container">
                    <button type="button"
                        class="zona-toggle w-full flex justify-between items-center p-3 bg-gray-50 hover:bg-gray-100 transition duration-200">
                        <span class="font-medium text-gray-700">{{ ucfirst($zona) }}
                            <span class="text-sm text-gray-500">({{ count($ejercicios) }} ejercicios)</span>
                            @php
                            $ejerciciosSeleccionadosEnZona = $ejerciciosAsignados->where('zona', $zona)->count();
                            @endphp
                            @if($ejerciciosSeleccionadosEnZona > 0)
                            <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded-full">
                                {{ $ejerciciosSeleccionadosEnZona }} seleccionados
                            </span>
                            @endif
                        </span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div class="zona-content hidden p-3 border-t border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="py-2 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Seleccionar</th>
                                        <th
                                            class="py-2 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre</th>
                                        <th
                                            class="py-2 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipo</th>
                                        <th
                                            class="py-2 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Series</th>
                                        <th
                                            class="py-2 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Repeticiones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ejercicios as $ejercicio)
                                    @php
                                    $estaAsignado = $ejerciciosAsignados->contains('id_ejercicio',
                                    $ejercicio->id_ejercicio);
                                    $ejercicioAsignado = $estaAsignado ?
                                    $ejerciciosAsignados->firstWhere('id_ejercicio', $ejercicio->id_ejercicio) : null;
                                    @endphp
                                    <tr class="hover:bg-gray-50 ejercicio-row {{ $estaAsignado ? 'bg-blue-50' : '' }}"
                                        data-id="{{ $ejercicio->id_ejercicio }}">
                                        <td class="py-2 px-4 border-b">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox"
                                                    class="ejercicio-checkbox form-checkbox h-5 w-5 text-blue-600"
                                                    data-id="{{ $ejercicio->id_ejercicio }}" {{ $estaAsignado
                                                    ? 'checked' : '' }}>
                                                <span class="ml-2 text-sm text-gray-600">Incluir</span>
                                            </label>

                                            <!-- Campo oculto para el ejercicio -->
                                            <input type="hidden" class="ejercicio-input" name="ejercicios[]"
                                                value="{{ $ejercicio->id_ejercicio }}" {{ $estaAsignado ? ''
                                                : 'disabled' }}>
                                        </td>
                                        <td class="py-2 px-4 border-b font-medium">{{ $ejercicio->nombre }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $ejercicio->tipo == 'fuerza' ? 'bg-blue-100 text-blue-800' : 
                                                   ($ejercicio->tipo == 'cardio' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                                                {{ $ejercicio->tipo }}
                                            </span>
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <div class="flex items-center">
                                                <input type="number"
                                                    class="series-input w-16 px-2 py-1 border rounded focus:ring-blue-500 focus:border-blue-500"
                                                    name="series[]" min="1" max="10"
                                                    value="{{ $estaAsignado ? $ejercicioAsignado->pivot->series : '' }}"
                                                    {{ $estaAsignado ? '' : 'disabled' }}>
                                            </div>
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <div class="flex items-center">
                                                <input type="number"
                                                    class="repeticiones-input w-16 px-2 py-1 border rounded focus:ring-blue-500 focus:border-blue-500"
                                                    name="repeticiones[]" min="1" max="100"
                                                    value="{{ $estaAsignado ? $ejercicioAsignado->pivot->repeticiones : '' }}"
                                                    {{ $estaAsignado ? '' : 'disabled' }}>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('administracion.rutinas.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2 transition duration-200">
                Cancelar
            </a>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded transition duration-200">
                Guardar Asignación
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejo de acordeón para zonas
        document.querySelectorAll('.zona-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                this.nextElementSibling.classList.toggle('hidden');
                const arrow = this.querySelector('svg');
                if (arrow) arrow.classList.toggle('rotate-180');
            });
        });
        
        // Manejo de checkboxes de ejercicios
        document.querySelectorAll('.ejercicio-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('tr');
                const ejercicioInput = row.querySelector('.ejercicio-input');
                const seriesInput = row.querySelector('.series-input');
                const repeticionesInput = row.querySelector('.repeticiones-input');
                
                // Habilitar o deshabilitar los inputs según el estado del checkbox
                [ejercicioInput, seriesInput, repeticionesInput].forEach(input => {
                    input.disabled = !this.checked;
                });
                
                // Si el checkbox está marcado
                if (this.checked) {
                    row.classList.add('bg-blue-50');
                    
                    // Establecer automáticamente 3 series y 12 repeticiones si están vacíos
                    if (!seriesInput.value || seriesInput.disabled) {
                        seriesInput.value = 3;
                    }
                    
                    if (!repeticionesInput.value || repeticionesInput.disabled) {
                        repeticionesInput.value = 12;
                    }
                } 
                // Si el checkbox está desmarcado
                else {
                    row.classList.remove('bg-blue-50');
                    
                    // NUEVO: Limpiar los valores de series y repeticiones
                    seriesInput.value = '';
                    repeticionesInput.value = '';
                }
            });
        });
        
        // Abrir acordeones que contienen ejercicios seleccionados
        const zonasConEjerciciosSeleccionados = new Set();
        document.querySelectorAll('.ejercicio-checkbox:checked').forEach(checkbox => {
            const zonaContainer = checkbox.closest('.zona-container');
            if (zonaContainer) {
                zonasConEjerciciosSeleccionados.add(zonaContainer);
            }
        });
        
        // Abrir los acordeones con ejercicios seleccionados
        zonasConEjerciciosSeleccionados.forEach(zona => {
            const toggle = zona.querySelector('.zona-toggle');
            if (toggle) toggle.click();
        });
    });
</script>
@endsection
