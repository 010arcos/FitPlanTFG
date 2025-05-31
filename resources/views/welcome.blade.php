<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NutriFit</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/guest.css') }}">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
            color: #333;
        }

        .navbar {
            background-color: black;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1.5rem 1rem;
        }


        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
            transition: color 0.3s ease;
            /* Opcional para una transición suave */
        }

        .navbar-brand:hover {
            color: white;
            scale: 1.05;
            /* Asegurarte de que el color se mantenga blanco */
        }

        .navbar .btn {
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
        }

        .hero {
            position: relative;
            text-align: center;
            padding: 6rem 2rem;
            background: url("{{ asset('img/dieta1.jpg') }}") no-repeat center center/cover;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1;
            /* Asegurar que el contenido esté por encima del pseudo-elemento */
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            /* Reducir opacidad para oscurecer menos */
            z-index: 0;
            /* Asegurar que el pseudo-elemento esté detrás del contenido */
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            animation: slideInLeft 1.5s ease-out;
            z-index: 2;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            animation: slideInRight 1.5s ease-out;
            z-index: 3;
        }

        .hero a {
            padding: 0.75rem 1.5rem;
            background: #1abc9c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
            z-index: 4;
        }

        .hero a:hover {
            background: #16a085;
            transform: scale(1.05);
            z-index: 5;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .features {
            padding: 4rem 2rem;
            background: #ecf0f1;
        }

        .feature-card {
            width: 100%;
            max-width: 350px;
            height: 100%;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            background: url("{{ asset('img/carta1.png') }}") no-repeat center center/cover;
            color: white;
            background-color: rgba(0, 0, 0, 0.6);
            background-blend-mode: darken;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .feature-card .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .feature-card h5 {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
            color: #f39c12;
            text-transform: uppercase;
        }

        .feature-card p {
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: center;
            color: #ecf0f1;
            padding: 0 1.5rem;
        }

        @media (max-width: 768px) {
            .feature-card {
                margin-bottom: 2rem;
            }
        }

        .cta {
            background: #34495e;
            color: white;
            text-align: center;
            padding: 4rem 2rem;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .cta a {
            padding: 0.75rem 1.5rem;
            background: #1abc9c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s;
        }

        .cta a:hover {
            background: #16a085;
            transform: scale(1.05);
        }

        footer {
            text-align: center;
            padding: 2rem;
            background: black;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">NutriFit</a>
            <div class="d-flex">

                @auth
                <!-- Si el usuario está autenticado -->
                @if(Auth::user()->roles->contains('name', 'admin'))
                <a href="{{ route('administracion') }}" class="btn btn-outline-light">Panel de Administración</a>
                @elseif(Auth::user()->roles->contains('name', 'user'))
                <a href="{{ route('usuario.index') }}" class="btn btn-outline-light">Mi Perfil</a>
                @else
                <!-- Opción por defecto si el usuario no tiene ni rol 'admin' ni rol 'user' -->
                <a href="{{ url('/') }}" class="btn btn-outline-light">Inicio</a>
                @endif
                @else
                <!-- Si el usuario NO está autenticado -->
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>








    <!-- Hero Section -->
    <div class="hero">
        <h1>Transforma tu vida con NutriFit</h1>
        <p>Tu aliado para una nutrición personalizada y un estilo de vida saludable.</p>
        <a href="#features" class="btn btn-lg">Descubre Más</a>
    </div>

    <!-- Features Section -->
    <div id="features" class="features">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="p-4 d-flex flex-column justify-content-center align-items-center text-center h-100">
                            <div class="icon mb-3" style="font-size: 2rem;">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <h5 class="mb-2">Planes de Comida</h5>
                            <p class="mb-0">Diseñamos planes de comida adaptados a tus necesidades.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="p-4 d-flex flex-column justify-content-center align-items-center text-center h-100">
                            <div class="icon mb-3" style="font-size: 2rem;">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <h5 class="mb-2">Nutrición Personalizada</h5>
                            <p class="mb-0">Recibe recomendaciones basadas en tus objetivos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="p-4 d-flex flex-column justify-content-center align-items-center text-center h-100">
                            <div class="icon mb-3" style="font-size: 2rem;">
                                <i class="bi bi-bar-chart-fill"></i>
                            </div>
                            <h5 class="mb-2">Seguimiento de Progreso</h5>
                            <p class="mb-0">Monitorea tus avances y ajusta tus metas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-card">
                        <div class="p-4 d-flex flex-column justify-content-center align-items-center text-center h-100">
                            <div class="icon mb-3" style="font-size: 2rem;">
                                <i class="bi bi-recipe"></i>
                            </div>
                            <h5 class="mb-2">Recetas Saludables</h5>
                            <p class="mb-0">Explora recetas deliciosas y fáciles de preparar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="cta">
        <h2>¿Listo para comenzar tu transformación?</h2>
        <a href="{{ route('register') }}" class="btn btn-lg">Únete Ahora</a>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 NutriFit. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
    <script>
        // Solución completa para forzar recarga al navegar hacia atrás
        window.addEventListener('pageshow', function(event) {
            // Si la página se carga desde caché (navegación hacia atrás)
            if (event.persisted) {
                location.reload(true); // true fuerza recarga desde servidor, no desde caché
            }
        });
        
        // Prevenir caché de página en algunos navegadores
        window.onunload = function() {};
    </script>
</body>

</html>