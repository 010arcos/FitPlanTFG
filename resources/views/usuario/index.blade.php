@extends('layouts.usuario.appUser')

@section('content')
<div class="modern-dashboard">
    <div class="dashboard-container">
        <!-- Sección de bienvenida y acceso rápido -->
        <div class="welcome-section">
            <h1 class="welcome-title">
                ¡Bienvenido, {{ $user->name }}!
            </h1>
            <p class="welcome-date">
                {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
            </p>
            <!-- Cartas de acceso rápido -->
            <div class="quick-access-cards">
                <div class="access-card">
                    <i class="fas fa-dumbbell" style="color:var(--primary);"></i>
                    <h3>Rutinas</h3>
                    <p>Consulta y sigue tu rutina de ejercicios personalizada.</p>
                    <a href="{{ route('usuario.rutina') }}" class="access-btn">Ir a Rutinas</a>
                </div>
                <div class="access-card">
                    <i class="fas fa-utensils" style="color:var(--accent);"></i>
                    <h3>Dieta</h3>
                    <p>Revisa tu plan de alimentación y tus comidas diarias.</p>
                    <a href="{{ route('usuario.dieta') }}" class="access-btn">Ir a Dieta</a>
                </div>
                <div class="access-card">
                    <i class="fas fa-chart-line" style="color:var(--success);"></i>
                    <h3>Progreso</h3>
                    <p>Visualiza tu evolución y tus logros en gráficos.</p>
                    <a href="{{ route('usuario.progreso') }}" class="access-btn">Ver Progreso</a>
                </div>
                <div class="access-card">
                    <i class="fas fa-user-check" style="color:var(--warning);"></i>
                    <h3>Medidas</h3>
                    <p>Registra y consulta tus medidas corporales e IMC.</p>
                    <a href="{{ route('usuario.progreso') }}#medidas" class="access-btn">Ver Medidas</a>
                </div>
            </div>
        </div>

        <!-- Información personal -->
        <div class="user-info-section">
            <div class="account-status">
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
            <div class="personal-info">
                <h3 class="info-title">Mi Información Personal</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-weight"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Peso Actual</span>
                            <span class="info-value">{{ $user->peso }} kg</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-ruler-vertical"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Altura</span>
                            <span class="info-value">{{ $user->altura }} cm</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Edad</span>
                            <span class="info-value">{{ $user->edad }} años</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $user->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Consejos de salud -->
        <div class="tip-section-large">
            <h2 class="section-title">Consejos de Salud</h2>
            <div class="tip-card" x-data="{ 
                currentTip: 0,
                tips: [
                    { title: 'Hidratación', text: 'Bebe al menos 8 vasos de agua al día para mantener tu cuerpo hidratado y tu metabolismo activo.', icon: 'fas fa-tint' },
                    { title: 'Descanso', text: 'Duerme entre 7-8 horas diarias. El descanso es fundamental para la recuperación muscular.', icon: 'fas fa-bed' },
                    { title: 'Alimentación', text: 'Come cada 3-4 horas para mantener tu metabolismo activo y evitar la ansiedad.', icon: 'fas fa-apple-alt' },
                    { title: 'Ejercicio', text: 'Realiza al menos 30 minutos de actividad física moderada la mayoría de días de la semana.', icon: 'fas fa-running' },
                    { title: 'Proteínas', text: 'Incluye proteínas en cada comida para mantener la masa muscular y sentirte saciado.', icon: 'fas fa-drumstick-bite' },
                    { title: 'Bebidas Saludables', text: 'Evita las bebidas azucaradas y opta por agua, té o infusiones naturales.', icon: 'fas fa-mug-hot' }
                ],
                nextTip() { this.currentTip = (this.currentTip + 1) % this.tips.length; },
                prevTip() { this.currentTip = this.currentTip === 0 ? this.tips.length - 1 : this.currentTip - 1; }
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
                    <div class="tip-progress-bar" :style="`width: ${((currentTip + 1) / tips.length) * 100}%`"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection