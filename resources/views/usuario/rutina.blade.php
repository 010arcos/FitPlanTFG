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
                    Rutinas
                </p>
            </div>

            <!-- Dashboard de fitness con Alpine.js -->
            <div class="fitness-dashboard" x-data="{ active: 'rutinas_lunes'}">
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
                    </ul>
                </nav>

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