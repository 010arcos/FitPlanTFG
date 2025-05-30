@extends('layouts.usuario.appUser')

@section('content')
<div class="routine-wrapper">
    <div class="routine-container">

        <!-- Header súper compacto -->
        <div class="compact-header">
            <div class="header-content">
                <i class="fas fa-dumbbell"></i>
                <h1>Mi Entrenamiento</h1>
            </div>
            <span class="current-date">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
        </div>

        <!-- Dashboard de rutinas -->
        <div class="routine-dashboard" x-data="{ activeDay: 'lunes' }">

            <!-- Navegación lateral -->
            <aside class="routine-sidebar">
                <div class="sidebar-header">
                    <h3>Días</h3>
                </div>

                <nav class="routine-navigation">
                    @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
                    <button class="nav-item" :class="{ 'nav-item-active': activeDay === '{{ $dia }}' }"
                        @click="activeDay = '{{ $dia }}'">
                        <span class="nav-icon">
                            @switch($dia)
                            @case('lunes') <i class="fas fa-fire"></i> @break
                            @case('martes') <i class="fas fa-dumbbell"></i> @break
                            @case('miercoles') <i class="fas fa-bolt"></i> @break
                            @case('jueves') <i class="fas fa-weight-hanging"></i> @break
                            @case('viernes') <i class="fas fa-bullseye"></i> @break
                            @case('sabado') <i class="fas fa-rocket"></i> @break
                            @case('domingo') <i class="fas fa-bed"></i> @break
                            @endswitch
                        </span>
                        <span class="nav-label">{{ ucfirst($dia) }}</span>
                    </button>
                    @endforeach
                </nav>
            </aside>

            <!-- Contenido principal -->
            <main class="routine-content">
                <!-- Secciones por día -->
                @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
                <section x-show="activeDay === '{{ $dia }}'" x-cloak class="day-section">

                    <!-- Header del día minimalista -->
                    <div class="day-header">
                        <h2>
                            @switch($dia)
                            @case('lunes') <i class="fas fa-fire"></i> @break
                            @case('martes') <i class="fas fa-dumbbell"></i> @break
                            @case('miercoles') <i class="fas fa-bolt"></i> @break
                            @case('jueves') <i class="fas fa-weight-hanging"></i> @break
                            @case('viernes') <i class="fas fa-bullseye"></i> @break
                            @case('sabado') <i class="fas fa-rocket"></i> @break
                            @case('domingo') <i class="fas fa-bed"></i> @break
                            @endswitch
                            {{ ucfirst($dia) }}
                        </h2>
                    </div>

                    @php
                    $rutinasDelDia = isset($rutinas) ? $rutinas->where('dia', $dia) : collect();
                    @endphp

                    @if(isset($rutinas) && $rutinasDelDia->count() > 0)
                    <div class="routines-grid">
                        @foreach($rutinasDelDia as $rutina)
                        <article class="routine-card">
                            <!-- Header de la rutina -->
                            <header class="routine-card-header">
                                <div class="routine-header-flex">
                                    <h3 class="routine-name">{{ $rutina->nombre }}</h3>
                                    <span class="routine-type">{{ $rutina->descripcion }}</span>
                                </div>
                            </header>

                            @if($rutina->ejercicios && $rutina->ejercicios->count() > 0)
                            <!-- Lista de ejercicios -->
                            <div class="routine-exercises">
                                <h4 class="exercises-title">
                                    <i class="fas fa-list"></i>
                                    Ejercicios:
                                </h4>
                                <div class="exercises-list">
                                    @foreach($rutina->ejercicios as $ejercicio)
                                    <div class="exercise-item">
                                        <div class="exercise-info">
                                            <span class="exercise-name">{{ $ejercicio->nombre }}</span>
                                            @if($ejercicio->descripcion)
                                            <span class="exercise-description">{{ $ejercicio->descripcion }}</span>
                                            @endif
                                        </div>
                                        <div class="exercise-stats">
                                            <div class="stat-item stat-series">
                                                <span class="stat-value">{{ $ejercicio->pivot->series }}</span>
                                                <span class="stat-label">Series</span>
                                            </div>
                                            <div class="stat-item stat-reps">
                                                <span class="stat-value">{{ $ejercicio->pivot->repeticiones }}</span>
                                                <span class="stat-label">Reps</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Resumen de la rutina -->
                            <footer class="routine-summary">
                                <div class="summary-item">
                                    <i class="fas fa-list-ol"></i>
                                    <span class="summary-value">{{ $rutina->ejercicios->count() }}</span>
                                    <span class="summary-label">Ejercicios</span>
                                </div>
                                <div class="summary-item">
                                    <i class="fas fa-layer-group"></i>
                                    <span class="summary-value">{{ $rutina->ejercicios->sum('pivot.series') }}</span>
                                    <span class="summary-label">Series</span>
                                </div>
                                <div class="summary-item">
                                    <i class="fas fa-clock"></i>
                                    <span class="summary-value">~{{ $rutina->ejercicios->count() * 3 }}min</span>
                                    <span class="summary-label">Tiempo</span>
                                </div>
                            </footer>
                            @else

                            <div class="no-exercises-state">
                                <i class="fas fa-exclamation-triangle no-exercises-icon"></i>
                                <p class="no-exercises-text">Sin ejercicios asignados</p>
                            </div>
                            @endif
                        </article>
                        @endforeach
                    </div>
                    @else
                    <!-- Estado vacío para el día -->
                    <div class="empty-day-state">
                        @if($dia === 'domingo')
                        <div class="rest-day-content">
                            <i class="fas fa-bed rest-icon"></i>
                            <h3 class="rest-title">Día de Descanso</h3>
                            <p class="rest-description">
                                Tu cuerpo necesita recuperarse. ¡Descansa bien!
                            </p>
                            <div class="rest-tips">
                                <h4><i class="fas fa-lightbulb"></i> Tips de descanso:</h4>
                                <ul>
                                    <li><i class="fas fa-tint"></i> Mantente hidratado</li>
                                    <li><i class="fas fa-apple-alt"></i> Come nutritivo</li>
                                    <li><i class="fas fa-moon"></i> Duerme 7-8 horas</li>
                                    <li><i class="fas fa-walking"></i> Camina suavemente</li>
                                </ul>
                            </div>
                        </div>
                        @else
                        <i class="fas fa-dumbbell empty-icon"></i>
                        <h3 class="empty-title">Sin rutinas para {{ $dia }}</h3>
                        <p class="empty-description">
                            No hay ejercicios programados.
                        </p>
                        <p class="empty-suggestion">
                            Consulta con tu entrenador.
                        </p>
                        @endif
                    </div>
                    @endif
                </section>
                @endforeach

                @if(!isset($rutinas) || $rutinas->count() === 0)
                <!-- Estado sin rutinas -->
                <div class="no-routines-state">
                    <i class="fas fa-exclamation-circle no-routines-icon"></i>
                    <h2 class="no-routines-title">Sin rutinas asignadas</h2>
                    <p class="no-routines-description">
                        No tienes plan de entrenamiento asignado.
                    </p>
                    <p class="no-routines-suggestion">
                        Contacta con tu entrenador.
                    </p>
                </div>
                @endif
            </main>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
    console.log('Routine dashboard initialized');
});
</script>
@endsection