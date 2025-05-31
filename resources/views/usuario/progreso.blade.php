@extends('layouts.usuario.appUser')

@section('content')


<div class="progress-wrapper">
    <div class="progress-container">
        <!-- Header compacto -->
        <!-- <div class="compact-header">
            <div class="header-content">
                <i class="fas fa-chart-line"></i>
                <h1>Mi Progreso</h1>
            </div>
            <div class="current-date">
                {{ date('l, d \d\e F \d\e Y') }}
            </div>
        </div> -->

        <!-- Dashboard de progreso -->
        <div class="progress-dashboard" x-data="{ 
            activeSection: 'medidas', 
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
                    <h3><i class="fas fa-chart-line"></i> Mi Progreso</h3>
                </div>

                <nav class="progress-navigation">
                    <!-- MEDIDAS PRIMERO -->
                    <button class="nav-item" :class="{ 'nav-item-active': activeSection === 'medidas' }"
                        @click="activeSection = 'medidas'; calculateIMC()">
                        <span class="nav-icon"><i class="fas fa-ruler"></i></span>
                        <span class="nav-label">Medidas</span>
                    </button>

                    <!-- PESO SEGUNDO -->
                    <button class="nav-item" :class="{ 'nav-item-active': activeSection === 'peso' }"
                        @click="activeSection = 'peso'">
                        <span class="nav-icon"><i class="fas fa-weight"></i></span>
                        <span class="nav-label">Peso</span>
                    </button>

                    <!-- IMC TERCERO -->
                    <button class="nav-item" :class="{ 'nav-item-active': activeSection === 'imc' }"
                        @click="activeSection = 'imc'">
                        <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                        <span class="nav-label">IMC</span>
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
                            Mis Medidas
                        </h2>

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