@extends('layouts.usuario.appUser')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Contenedor principal con el mensaje de bienvenida -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl p-8">
            <div class="text-center">
                <!-- Título -->
                <h2 class="text-4xl font-extrabold text-teal-600 mb-6">
                    ¡Bienvenido {{ Auth::user()->name }}!
                </h2>

                <!-- Mensaje breve -->
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-10">
                    Dietas y Ejercicios
                </p>
            </div>

            <!-- Dashboard de fitness con Alpine.js -->
            <div class="fitness-dashboard"
                x-data="{ active: 'rutinas_lunes', selectedDieta: '{{ count($dietas) > 0 ? $dietas[0]->id_dieta : '' }}' }">
                <!-- Menú lateral -->
                <nav class="fitness-menu">
                    <ul>
                        <!-- Rutinas -->
                        <li>
                            <details class="menu-item" :open="active.startsWith('rutinas')">
                                <summary class="menu-header" @click.prevent="active = 'rutinas_lunes'">
                                    Rutinas
                                    <span class="chevron">▾</span>
                                </summary>
                                <ul class="submenu">
                                    @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo']
                                    as $dia)
                                    <li>
                                        <button class="submenu-link"
                                            :class="{ 'active': active==='rutinas_{{ $dia }}' }"
                                            @click.prevent="active='rutinas_{{ $dia }}'">
                                            {{ ucfirst($dia) }}
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                            </details>
                        </li>

                        <!-- Dietas -->
                        <li>
                            <details class="menu-item" :open="active.startsWith('dietas')">
                                <summary class="menu-header" @click.prevent="active = 'dietas_desayuno'">
                                    Dietas
                                    <span class="chevron">▾</span>
                                </summary>
                                <ul class="submenu">
                                    @foreach(['desayuno', 'almuerzo', 'comida', 'merienda', 'cena'] as $comida)
                                    <li>
                                        <button class="submenu-link"
                                            :class="{ 'active': active==='dietas_{{ $comida }}' }"
                                            @click.prevent="active='dietas_{{ $comida }}'">
                                            {{ ucfirst($comida) }}
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                            </details>
                        </li>

                        <!-- Progreso -->
                        <li>
                            <details class="menu-item" :open="active.startsWith('progreso')">
                                <summary class="menu-header" @click.prevent="active = 'progreso_peso'">
                                    Mi Progreso
                                    <span class="chevron">▾</span>
                                </summary>
                                <ul class="submenu">
                                    <li>
                                        <button class="submenu-link" :class="{ 'active': active==='progreso_peso' }"
                                            @click.prevent="active='progreso_peso'">
                                            Peso
                                        </button>
                                    </li>
                                    <li>
                                        <button class="submenu-link" :class="{ 'active': active==='progreso_medidas' }"
                                            @click.prevent="active='progreso_medidas'">
                                            Medidas
                                        </button>
                                    </li>
                                </ul>
                            </details>
                        </li>
                    </ul>
                </nav>

                <!-- Contenido dinámico -->
                <div class="fitness-content">
                    <!-- Rutinas por día -->
                    @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
                    <section x-show="active==='rutinas_{{ $dia }}'" x-cloak class="content-section">
                        <div class="section-header">
                            <h2>Rutina de {{ ucfirst($dia) }}</h2>
                            <p class="section-date">{{ date('d/m/Y') }}</p>
                        </div>

                        @php
                        $rutinasDelDia = isset($rutinas) ? $rutinas->where('dia', $dia) : collect();
                        @endphp

                        @if(isset($rutinas) && $rutinasDelDia->count() > 0)
                        <div class="exercise-grid">
                            @foreach($rutinasDelDia as $rutina)
                            <div class="exercise-card">
                                <div class="exercise-header">
                                    <h3>{{ $rutina->nombre }}</h3>
                                    <span class="exercise-type">{{ $rutina->descripcion }}</span>
                                </div>

                                @if($rutina->ejercicios && $rutina->ejercicios->count() > 0)
                                <div class="exercise-list">
                                    <h4>Ejercicios</h4>
                                    <ul>
                                        @foreach($rutina->ejercicios as $ejercicio)
                                        <li>
                                            <div class="exercise-item">
                                                <span class="exercise-name">{{ $ejercicio->nombre }}</span>
                                                <div class="exercise-details">
                                                    <span>{{ $ejercicio->pivot->series }} series</span>
                                                    <span>{{ $ejercicio->pivot->repeticiones }} reps</span>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="empty-state">
                            <div class="empty-icon">🏋️</div>
                            <p>No hay rutinas programadas para este día</p>
                            <p class="empty-subtitle">Descansa o consulta con tu entrenador</p>
                        </div>
                        @endif
                    </section>
                    @endforeach

                    <!-- Dietas por tipo de comida -->
                    @foreach(['desayuno', 'almuerzo', 'comida', 'merienda', 'cena'] as $tipoComida)
                    <section x-show="active==='dietas_{{ $tipoComida }}'" x-cloak class="content-section">
                        <div class="section-header">
                            <h2>{{ ucfirst($tipoComida) }}</h2>
                            <p class="section-date">{{ date('d/m/Y') }}</p>
                        </div>

                        @if(count($dietas) > 0)
                        <!-- Selector de dieta -->
                        <div class="diet-selector mb-6">
                            <label for="diet-select"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Selecciona una dieta:
                            </label>
                            <select id="diet-select" x-model="selectedDieta"
                                class="block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach($dietas as $dieta)
                                <option value="{{ $dieta->id_dieta }}">{{ $dieta->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mostrar las comidas de la dieta seleccionada -->
                        @foreach($dietasOrganizadas as $dietaId => $dietaData)
                        <div x-show="selectedDieta == '{{ $dietaId }}'">
                            @if(isset($dietaData['comidas'][$tipoComida]) && count($dietaData['comidas'][$tipoComida]) >
                            0)
                            @foreach($dietaData['comidas'][$tipoComida] as $comida)
                            <div class="meal-card">
                                <div class="meal-header">
                                    <h3>{{ $comida->nombre }}</h3>
                                    <span class="meal-calories">{{ $comida->calorias }} calorías</span>
                                </div>

                                @php
                                $alimentos = json_decode($comida->alimentos, true);
                                @endphp

                                @if($alimentos && isset($alimentos['ingredientes']))
                                <div class="ingredients-list">
                                    <h4>Ingredientes:</h4>
                                    <ul>
                                        @foreach($alimentos['ingredientes'] as $ingrediente)
                                        <li>
                                            <span class="ingredient-name">{{ $ingrediente['nombre'] }}</span>
                                            <span class="ingredient-amount">{{ $ingrediente['cantidad'] }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                @php
                                $macros = json_decode($comida->macros, true);
                                @endphp

                                @if($macros)
                                <div class="macros-info">
                                    <div class="macro-item">
                                        <span class="macro-value">{{ $macros['proteinas'] }}g</span>
                                        <span class="macro-label">Proteínas</span>
                                    </div>
                                    <div class="macro-item">
                                        <span class="macro-value">{{ $macros['carbohidratos'] }}g</span>
                                        <span class="macro-label">Carbohidratos</span>
                                    </div>
                                    <div class="macro-item">
                                        <span class="macro-value">{{ $macros['grasas'] }}g</span>
                                        <span class="macro-label">Grasas</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                            @else
                            <div class="empty-state">
                                <div class="empty-icon">🍽️</div>
                                <p>No hay {{ $tipoComida }} programado para esta dieta</p>
                                <p class="empty-subtitle">Consulta con tu nutricionista</p>
                            </div>
                            @endif
                        </div>
                        @endforeach
                        @else
                        <div class="empty-state">
                            <div class="empty-icon">🍽️</div>
                            <p>No tienes dietas asignadas</p>
                            <p class="empty-subtitle">Consulta con tu nutricionista</p>
                        </div>
                        @endif
                    </section>
                    @endforeach

                    <!-- Secciones de progreso -->
                    <section x-show="active==='progreso_peso'" x-cloak class="content-section">
                        <div class="section-header">
                            <h2>Seguimiento de Peso</h2>
                            <p class="section-date">Actualizado: {{ date('d/m/Y') }}</p>
                        </div>

                        <div class="progress-chart">
                            <div class="chart-placeholder">
                                <div class="empty-icon">📊</div>
                                <p>Gráfico de progreso de peso</p>
                                <p class="empty-subtitle">Próximamente</p>
                            </div>
                        </div>
                    </section>

                    <section x-show="active==='progreso_medidas'" x-cloak class="content-section">
                        <div class="section-header">
                            <h2>Medidas Corporales</h2>
                            <p class="section-date">Actualizado: {{ date('d/m/Y') }}</p>
                        </div>

                        <div class="empty-state">
                            <div class="empty-icon">📏</div>
                            <p>Seguimiento de medidas corporales</p>
                            <p class="empty-subtitle">Próximamente</p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Asegúrate de que Alpine.js esté cargado
    document.addEventListener('alpine:init', () => {
        // Inicialización de componentes Alpine si es necesario
    });
</script>
@endsection