@extends('layouts.usuario.appUser')

@section('content')
<div class="modern-dashboard">
    <div class="dashboard-container">
        <header class="main-header">
            <div class="header-content">
                <h1 class="welcome-text">¡Bienvenido, {{ $user->name }}!</h1>
                <p class="user-info">Peso: {{ $user->peso }} kg | Edad: {{ $user->edad }} años</p>
            </div>
        </header>

        <div class="content">
            <section class="quick-access-cards">
                <div class="access-card">
                    <i class="fas fa-dumbbell" style="color: var(--primary);"></i>
                    <h3>Rutinas</h3>
                    <p>Consulta y sigue tu rutina de ejercicios personalizada.</p>
                    <a href="{{ route('usuario.rutina') }}" class="access-btn">Ir a Rutinas</a>
                </div>
                <div class="access-card">
                    <i class="fas fa-utensils" style="color: var(--accent);"></i>
                    <h3>Dieta</h3>
                    <p>Revisa tu plan de alimentación y tus comidas diarias.</p>
                    <a href="{{ route('usuario.dieta') }}" class="access-btn">Ir a Dieta</a>
                </div>
                <div class="access-card">
                    <i class="fas fa-chart-line" style="color: var(--success);"></i>
                    <h3>Progreso</h3>
                    <p>Visualiza tu evolución y tus logros en gráficos.</p>
                    <a href="{{ route('usuario.progreso') }}" class="access-btn">Ver Progreso</a>
                </div>
            </section>
        </div>

    <footer class="footer">
            <p>© 2023 Fit Plan. Todos los derechos reservados.</p>
        </footer>
    </div>
</div>
@endsection