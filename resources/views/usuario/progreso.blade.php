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
                    Progreso
                </p>
            </div>

            <!-- Dashboard de fitness con Alpine.js -->
            <div class="fitness-dashboard" x-data="{ active: 'progreso_peso' }">
                <!-- Menú lateral -->
                <nav class="fitness-menu">
                    <ul>


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