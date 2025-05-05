<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NutriFit</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

        .hero {
            position: relative;
            text-align: center;
            padding: 6rem 2rem;
            background: url('/Img/dieta1.jpg') no-repeat center center/cover;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .login-form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-top: 2rem;
        }

        .login-form label {
            color: #333;
        }

        .login-form input {
            margin-bottom: 1rem;
            color: #333;
        }

        .login-form .form-check-label {
            color: #333;
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

        footer {
            text-align: center;
            padding: 2rem;
            background: black;
            color: white;
        }

        .form-check-input {
            margin-left: 0.5rem;
        }

        .forgot-password-link {
            font-size: 0.875rem;
            color: #007bff;
        }

        .forgot-password-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">NutriFit</a>
            <div class="d-flex">
                <a href="#" class="btn btn-light me-2">Sobre Nosotros</a>
                <a href="{{ route('login') }}" class="btn btn-outline-light">Iniciar sesion</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Bienvenido a NutriFit</h1>
        <p>Regístrate para comenzar tu transformación.</p>

        <!-- Register Form -->
        <div class="login-form">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required
                        autofocus autocomplete="name">
                    @error('name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required
                        autocomplete="username">
                    @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" class="form-control" type="password" name="password" required
                        autocomplete="new-password">
                    @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                        required autocomplete="new-password">
                    @error('password_confirmation')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">¿Ya tienes
                        cuenta?</a>

                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>
            </form>
        </div>
    </div>

    {{--
    <!-- Call to Action Section -->
    <div class="cta">
        <h2>¿Ya tienes cuenta?</h2>
        <a href="{{ route('login') }}" class="btn btn-lg">Inicia sesión ahora</a>
    </div> --}}

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 NutriFit. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
</body>

</html>