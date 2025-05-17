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
                <p class="text-gray-700"><span class="font-semibold">Fechas:</span> {{ date('d/m/Y',
                    strtotime($rutina->fecha_inicio)) }} - {{ date('d/m/Y', strtotime($rutina->fecha_fin)) }}</p>
            </div>

            <!-- Selector de día -->
            <div class="mb-6">
                <label for="dia_seleccionado" class="block text-sm font-medium text-gray-700 mb-2">Seleccionar día para
                    asignar ejercicios:</label>
                <select id="dia_seleccionado" name="dia_seleccionado"
                    class="w-full md:w-64 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @foreach($diasSemana as $dia)
                    <option value="{{ $dia }}">
                        {{ ucfirst($dia) }}
                        @if(isset($ejerciciosAsignados[$dia]) && count($ejerciciosAsignados[$dia]) > 0)
                        ({{ count($ejerciciosAsignados[$dia]) }} ejercicios)
                        @endif
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Acordeón para zonas musculares -->
            <div class="mb-4 space-y-3">
                @foreach($ejerciciosPorZona as $zona => $ejercicios)
                <div class="border border-gray-200 rounded-lg overflow-hidden zona-container">
                    <button type="button"
                        class="zona-toggle w-full flex justify-between items-center p-3 bg-gray-50 hover:bg-gray-100 transition duration-200">
                        <span class="font-medium text-gray-700">{{ ucfirst($zona) }} <span
                                class="text-sm text-gray-500">({{ count($ejercicios) }} ejercicios)</span></span>
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
                                    <tr class="hover:bg-gray-50 ejercicio-row" data-id="{{ $ejercicio->id_ejercicio }}">
                                        <td class="py-2 px-4 border-b">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox"
                                                    class="ejercicio-checkbox form-checkbox h-5 w-5 text-blue-600"
                                                    data-id="{{ $ejercicio->id_ejercicio }}">
                                                <span class="ml-2 text-sm text-gray-600">Incluir</span>
                                            </label>

                                            <!-- Campo oculto para el ejercicio -->
                                            <input type="hidden" class="ejercicio-input" name="ejercicios[]"
                                                value="{{ $ejercicio->id_ejercicio }}" disabled>

                                            <!-- Campo oculto para el día -->
                                            <input type="hidden" class="dia-input" name="dias[]" disabled>
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
                                                    name="series[]" min="1" max="10" disabled>
                                            </div>
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <div class="flex items-center">
                                                <input type="number"
                                                    class="repeticiones-input w-16 px-2 py-1 border rounded focus:ring-blue-500 focus:border-blue-500"
                                                    name="repeticiones[]" min="1" max="100" disabled>
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
        // Datos de ejercicios asignados por día
        const ejerciciosAsignados = {
            @foreach($diasSemana as $dia)
                '{{ $dia }}': [
                    @if(isset($ejerciciosAsignados[$dia]))
                        @foreach($ejerciciosAsignados[$dia] as $ejercicio)
                            {
                                id: {{ $ejercicio->id_ejercicio }},
                                series: {{ $ejercicio->pivot->series }},
                                repeticiones: {{ $ejercicio->pivot->repeticiones }}
                            },
                        @endforeach
                    @endif
                ],
            @endforeach
        };
        
        // Manejo del selector de día
        const diaSelector = document.getElementById('dia_seleccionado');
        
        // Función para actualizar los ejercicios según el día seleccionado
        function actualizarEjercicios() {
            const diaSeleccionado = diaSelector.value;
            const ejerciciosDelDia = ejerciciosAsignados[diaSeleccionado] || [];
            
            // Resetear todos los checkboxes y campos
            document.querySelectorAll('.ejercicio-row').forEach(row => {
                const ejercicioId = row.dataset.id;
                const checkbox = row.querySelector('.ejercicio-checkbox');
                const ejercicioInput = row.querySelector('.ejercicio-input');
                const diaInput = row.querySelector('.dia-input');
                const seriesInput = row.querySelector('.series-input');
                const repeticionesInput = row.querySelector('.repeticiones-input');
                
                // Desmarcar checkbox y deshabilitar campos
                checkbox.checked = false;
                ejercicioInput.disabled = true;
                diaInput.disabled = true;
                seriesInput.disabled = true;
                repeticionesInput.disabled = true;
                
                // Limpiar valores
                seriesInput.value = '';
                repeticionesInput.value = '';
                
                // Actualizar el valor del día
                diaInput.value = diaSeleccionado;
                
                // Buscar si este ejercicio está asignado al día seleccionado
                const ejercicioAsignado = ejerciciosDelDia.find(e => e.id == ejercicioId);
                if (ejercicioAsignado) {
                    checkbox.checked = true;
                    ejercicioInput.disabled = false;
                    diaInput.disabled = false;
                    seriesInput.disabled = false;
                    repeticionesInput.disabled = false;
                    seriesInput.value = ejercicioAsignado.series;
                    repeticionesInput.value = ejercicioAsignado.repeticiones;
                }
            });
        }
        
        // Evento para cambio de día
        diaSelector.addEventListener('change', actualizarEjercicios);
        
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
                const inputs = [
                    row.querySelector('.ejercicio-input'),
                    row.querySelector('.dia-input'),
                    row.querySelector('.series-input'),
                    row.querySelector('.repeticiones-input')
                ];
                
                inputs.forEach(input => {
                    input.disabled = !this.checked;
                });
            });
        });
        
        // Inicializar la vista
        actualizarEjercicios();
        
        // Abrir el primer acordeón por defecto
        const primerToggle = document.querySelector('.zona-toggle');
        if (primerToggle) primerToggle.click();
    });
</script>
@endsection