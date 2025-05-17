@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-xl sm:text-2xl font-bold mb-4">Rutina semanal de {{ $usuario->name }} {{
                    $usuario->apellido }}</h2>

                <!-- Botones de navegación -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 mb-4">
                    <a href="{{ route('administracion.usuarios.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-300 ease-in-out text-center">
                        Volver a usuarios
                    </a>
                    <a href="{{ route('administracion.rutinas.asignar.usuario', $usuario->id) }}"
                        class="bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 transition duration-300 ease-in-out text-center">
                        Asignar nueva rutina
                    </a>
                </div>

                <!-- Selector de días (pestañas) -->
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="diasTab" role="tablist">
                        @foreach($diasSemana as $index => $dia)
                        <li class="mr-2" role="presentation">
                            <button
                                class="inline-block p-4 border-b-2 rounded-t-lg {{ $index === 0 ? 'border-teal-500 text-teal-500' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300' }}"
                                id="tab-{{ $dia }}" data-tabs-target="#content-{{ $dia }}" type="button" role="tab"
                                aria-controls="content-{{ $dia }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                                onclick="cambiarTab('{{ $dia }}')">
                                {{ ucfirst($dia) }}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contenido de las pestañas -->
                <div id="diasTabContent">
                    @foreach($diasSemana as $index => $dia)
                    <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800 {{ $index === 0 ? 'block' : 'hidden' }}"
                        id="content-{{ $dia }}" role="tabpanel" aria-labelledby="tab-{{ $dia }}">

                        @if(count($ejerciciosPorDia[$dia]) > 0)
                        @foreach($ejerciciosPorDia[$dia] as $item)
                        <div class="mb-4 bg-white dark:bg-gray-700 rounded-lg p-4 shadow">
                            <h4 class="text-lg font-semibold mb-3 text-teal-600 dark:text-teal-400">
                                {{ $item['rutina']->nombre }}
                            </h4>
                            <div class="space-y-3">
                                @foreach($item['ejercicios'] as $ejercicio)
                                <div
                                    class="p-3 bg-gray-50 dark:bg-gray-600 rounded border border-gray-200 dark:border-gray-500">
                                    <div class="font-medium">{{ $ejercicio->nombre }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                        {{ $ejercicio->descripcion }}
                                    </div>
                                    <div class="flex justify-between mt-2 text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">
                                            Series: <span class="font-medium">{{ $ejercicio->pivot->series }}</span>
                                        </span>
                                        <span class="text-gray-500 dark:text-gray-400">
                                            Repeticiones: <span class="font-medium">{{ $ejercicio->pivot->repeticiones
                                                }}</span>
                                        </span>
                                    </div>
                                    <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                        Zona: {{ $ejercicio->zona }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <p>Descanso para este día</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

               
            </div>
        </div>
    </div>
</div>

<script>
    function cambiarTab(diaId) {
        // Ocultar todos los contenidos
        document.querySelectorAll('[id^="content-"]').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Mostrar el contenido seleccionado
        document.getElementById('content-' + diaId).classList.remove('hidden');
        
        // Actualizar estilos de las pestañas
        document.querySelectorAll('[id^="tab-"]').forEach(button => {
            button.classList.remove('border-teal-500', 'text-teal-500');
            button.classList.add('border-transparent');
            button.setAttribute('aria-selected', 'false');
        });
        
        // Activar la pestaña seleccionada
        const activeTab = document.getElementById('tab-' + diaId);
        activeTab.classList.remove('border-transparent');
        activeTab.classList.add('border-teal-500', 'text-teal-500');
        activeTab.setAttribute('aria-selected', 'true');
    }
</script>
@endsection