@extends('layouts.usuario.appUser')

@section('content')
<div class="progress-wrapper">
    <div class="progress-container">
        <!-- Header compacto -->
        <div class="compact-header">
            <div class="header-content">
                <i class="fas fa-chart-line"></i>
                <h1>Mi Progreso</h1>
            </div>
            <div class="current-date">
                {{ date('l, d \d\e F \d\e Y') }}
            </div>
        </div>

        <!-- Dashboard de progreso -->
        <div class="progress-dashboard" x-data="{ 
            activeSection: 'peso',
            formData: {
                peso: '{{ Auth::user()->peso ?? '' }}',
                altura: '{{ Auth::user()->altura ?? '' }}',
                notas: '',
                fecha_registro: '{{ date('Y-m-d') }}'
            },
            calculatedIMC: 0,
            calculateIMC() {
                if (this.formData.peso > 0 && this.formData.altura > 0) {
                    this.calculatedIMC = (this.formData.peso / (this.formData.altura * this.formData.altura)).toFixed(2);
                } else {
                    this.calculatedIMC = 0;
                }
            }
        }">

            <!-- Navegación lateral -->
            <aside class="progress-sidebar">
                <div class="sidebar-header">
                    <h3>Mi Progreso</h3>
                </div>

                <nav class="progress-navigation">
                    <button class="nav-item" :class="{ 'nav-item-active': activeSection === 'peso' }"
                        @click="activeSection = 'peso'">
                        <span class="nav-icon"><i class="fas fa-weight"></i></span>
                        <span class="nav-label">Peso</span>
                    </button>

                    <button class="nav-item" :class="{ 'nav-item-active': activeSection === 'imc' }"
                        @click="activeSection = 'imc'">
                        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                        <span class="nav-label">IMC</span>
                    </button>

                    <button class="nav-item" :class="{ 'nav-item-active': activeSection === 'medidas' }"
                        @click="activeSection = 'medidas'; calculateIMC()">
                        <span class="nav-icon"><i class="fas fa-ruler"></i></span>
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
                            <i class="fas fa-weight"></i>
                            Evolución del Peso
                        </h2>
                        <p class="section-date">Actualizado: {{ date('d/m/Y') }}</p>
                    </div>

                    @include('usuario.partials.graficoPeso')
                </section>

                <!-- Sección IMC -->
                <section x-show="activeSection === 'imc'" x-cloak class="progress-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-chart-line"></i>
                            Evolución del IMC
                        </h2>
                        <p class="section-date">Actualizado: {{ date('d/m/Y') }}</p>
                    </div>

                    @include('usuario.partials.graficoImc')
                </section>

                <!-- Sección Medidas - Formulario -->
                <section x-show="activeSection === 'medidas'" x-cloak class="progress-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-ruler"></i>
                            Mis Medidas Actuales
                        </h2>
                        <p class="section-date">Bienvenido {{ Auth::user()->name }}</p>
                    </div>

                    @include('usuario.partials.formMedidas')
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Script cargado');
    console.log('📊 Chart disponible:', typeof Chart);
    
    @if(isset($datosGraficos) && count($datosGraficos['pesos']) > 0)
        const datosGraficos = @json($datosGraficos);
        
        // Gráfico de peso
        const ctxPeso = document.getElementById('pesoChart');
        if (ctxPeso && typeof Chart !== 'undefined') {
            new Chart(ctxPeso, {
                type: 'line',
                data: {
                    labels: datosGraficos.fechas,
                    datasets: [{
                        label: 'Peso (kg)',
                        data: datosGraficos.pesos,
                        borderColor: '#1e40af',
                        backgroundColor: 'rgba(30, 64, 175, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
        
        // Gráfico de IMC
        const ctxIMC = document.getElementById('imcChart');
        if (ctxIMC && typeof Chart !== 'undefined') {
            new Chart(ctxIMC, {
                type: 'line',
                data: {
                    labels: datosGraficos.fechas,
                    datasets: [{
                        label: 'IMC',
                        data: datosGraficos.imcs,
                        borderColor: '#06b6d4',
                        backgroundColor: 'rgba(6, 182, 212, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    @endif
});
</script>
@endpush