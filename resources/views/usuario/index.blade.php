@extends('layouts.usuario.appUser')

@section('content')
<div class="modern-dashboard">
    <div class="dashboard-container">


        <header class="main-header">
            <div class="header-content">
               @if(session('error'))
                <div class="alert alert-danger"
                    style="max-width: 350px; margin: 20px auto; padding: 15px; border-radius: 8px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; display: flex; align-items: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <i class="fas fa-exclamation-circle" style="margin-right: 10px; font-size: 20px;"></i>
                    <span>{{ session('error') }}</span>
                </div>
                @endif
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