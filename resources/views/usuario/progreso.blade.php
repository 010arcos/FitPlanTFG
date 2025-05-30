@extends('layouts.usuario.appUser')

@section('content')
<div class="dashboard-wrapper">
    <div class="dashboard-container">
        <!-- Header de la página -->
        <div class="page-header">
            <div class="page-header-content">
                <h1 class="page-title">
                    <span class="page-icon">📊</span>
                    Mi Progreso
                </h1>
                <p class="page-subtitle">
                    Bienvenido {{ Auth::user()->name }} - {{ date('l, d \d\e F \d\e Y') }}
                </p>
            </div>
        </div>

        <!-- Dashboard de progreso -->
        <div class="progress-dashboard" x-data="{ activeSection: 'peso' }">

            <!-- Navegación lateral -->
            <aside class="progress-sidebar">
                <div class="sidebar-header">
                    <h3>Mi Progreso</h3>
                </div>

                <nav class="progress-navigation">
                    <button class="nav-item" :class="{ 'nav-item-active': activeSection === 'peso' }"
                        @click="activeSection = 'peso'">
                        <span class="nav-icon">⚖️</span>
                        <span class="nav-label">Peso</span>
                    </button>
                    
                    <button class="nav-item" :class="{ 'nav-item-active': activeSection === 'medidas' }"
                        @click="activeSection = 'medidas'">
                        <span class="nav-icon">📏</span>
                        <span class="nav-label">Medidas</span>
                    </button>
                </nav>
            </aside>

            <!-- Contenido principal -->
            <main class="progress-content">
                
                <!-- Sección Peso -->
                <section x-show="activeSection === 'peso'" x-cloak class="progress-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            ⚖️ Seguimiento de Peso
                        </h2>
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

                <!-- Sección Medidas -->
                <section x-show="activeSection === 'medidas'" x-cloak class="progress-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            📏 Medidas Corporales
                        </h2>
                        <p class="section-date">Actualizado: {{ date('d/m/Y') }}</p>
                    </div>

                    <div class="empty-state">
                        <div class="empty-icon">📏</div>
                        <p>Seguimiento de medidas corporales</p>
                        <p class="empty-subtitle">Próximamente</p>
                    </div>
                </section>
            </main>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    console.log('Progress dashboard initialized');
});
</script>
@endsection