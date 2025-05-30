@extends('layouts.usuario.appUser')

@section('content')
<div class="modern-dashboard">
    <div class="dashboard-container">

        <!-- Header minimalista -->
        <div class="welcome-section">
            <h1 class="welcome-title">Hola, {{ $user->name }}</h1>

            <p class="welcome-subtitle">{{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</p>

            @if(!$user->activo)
            <div class="status-alert">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Tu cuenta está inactiva. Contacta con el administrador.</span>
            </div>
            @else
            <div class="status-active">
                <i class="fas fa-check-circle"></i>
                <span>Cuenta activa</span>
            </div>
            @endif
        </div>

        <!-- Layout principal en 2 columnas -->
        <div class="main-layout">

            <!-- Columna izquierda: Stats principales -->
            <div class="left-column">

                <!-- Stats cards más grandes -->
                <div class="stats-section">
                    <h2 class="section-title">Mi Información Personal</h2>
                    <div class="stats-grid-large">
                        <div class="stat-card weight-card">
                            <div class="stat-content">
                                <h3>Peso Actual</h3>
                                <p class="stat-value">{{ $user->peso }} <span>kg</span></p>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-weight"></i>
                            </div>
                        </div>

                        <div class="stat-card height-card">
                            <div class="stat-content">
                                <h3>Altura</h3>
                                <p class="stat-value">{{ $user->altura }} <span>cm</span></p>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-ruler-vertical"></i>
                            </div>
                        </div>

                        <div class="stat-card age-card">
                            <div class="stat-content">
                                <h3>Edad</h3>
                                <p class="stat-value">{{ $user->edad }} <span>años</span></p>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-birthday-cake"></i>
                            </div>
                        </div>

                        <div class="stat-card email-card">
                            <div class="stat-content">
                                <h3>Email</h3>
                                <p class="stat-email">{{ $user->email }}</p>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Consejos con navegación - MÁS PROMINENTE -->
                <div class="tip-section-large">
                    <h2 class="section-title">Consejos de Salud</h2>
                    <div class="tip-card" x-data="{ 
                        currentTip: 0,
                        tips: [
                            {
                                title: 'Hidratación',
                                text: 'Bebe al menos 8 vasos de agua al día para mantener tu cuerpo hidratado y tu metabolismo activo.',
                                icon: 'fas fa-tint'
                            },
                            {
                                title: 'Descanso',
                                text: 'Duerme entre 7-8 horas diarias. El descanso es fundamental para la recuperación muscular.',
                                icon: 'fas fa-bed'
                            },
                            {
                                title: 'Alimentación',
                                text: 'Come cada 3-4 horas para mantener tu metabolismo activo y evitar la ansiedad.',
                                icon: 'fas fa-apple-alt'
                            },
                            {
                                title: 'Ejercicio',
                                text: 'Realiza al menos 30 minutos de actividad física moderada la mayoría de días de la semana.',
                                icon: 'fas fa-running'
                            },
                            {
                                title: 'Proteínas',
                                text: 'Incluye proteínas en cada comida para mantener la masa muscular y sentirte saciado.',
                                icon: 'fas fa-drumstick-bite'
                            },
                            {
                                title: 'Bebidas Saludables',
                                text: 'Evita las bebidas azucaradas y opta por agua, té o infusiones naturales.',
                                icon: 'fas fa-mug-hot'
                            }
                        ],
                        nextTip() {
                            this.currentTip = (this.currentTip + 1) % this.tips.length;
                        },
                        prevTip() {
                            this.currentTip = this.currentTip === 0 ? this.tips.length - 1 : this.currentTip - 1;
                        }
                    }">
                        <div class="tip-header">
                            <div class="tip-icon">
                                <i :class="tips[currentTip].icon"></i>
                            </div>
                            <h3 x-text="tips[currentTip].title"></h3>
                            <div class="tip-navigation">
                                <button @click="prevTip()" class="tip-nav-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <span class="tip-counter">
                                    <span x-text="currentTip + 1"></span>/<span x-text="tips.length"></span>
                                </span>
                                <button @click="nextTip()" class="tip-nav-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <p x-text="tips[currentTip].text"></p>
                        <div class="tip-progress">
                            <div class="tip-progress-bar" :style="`width: ${((currentTip + 1) / tips.length) * 100}%`">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Columna derecha: Info secundaria -->
            <div class="right-column">

                <!-- Reloj -->
                <div class="info-card time-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Hora Actual</h3>
                    </div>
                    <div class="time-display" id="current-time"></div>
                </div>

                <!-- Motivación del día -->
                <div class="motivation-card">
                    <div class="motivation-header">
                        <div class="motivation-icon">💪</div>
                        <h3>Motivación del Día</h3>
                    </div>
                    <p>"El éxito es la suma de pequeños esfuerzos repetidos día tras día."</p>
                </div>

                <!-- Acceso rápido MÁS PEQUEÑO -->
                <div class="quick-links">
                    <h3>Enlaces Rápidos</h3>
                    <div class="quick-links-grid">
                        <a href="{{ route('usuario.dieta') }}" class="quick-link">
                            <i class="fas fa-utensils"></i>
                            <span>Dieta</span>
                        </a>
                        <a href="{{ route('usuario.rutina') }}" class="quick-link">
                            <i class="fas fa-dumbbell"></i>
                            <span>Rutinas</span>
                        </a>
                        <a href="{{ route('usuario.progreso') }}" class="quick-link">
                            <i class="fas fa-chart-line"></i>
                            <span>Progreso</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
    // Reloj en tiempo real
function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('es-ES', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });
    const timeElement = document.getElementById('current-time');
    if (timeElement) {
        timeElement.textContent = timeString;
    }
}

setInterval(updateTime, 1000);
updateTime();
</script>
@endsection