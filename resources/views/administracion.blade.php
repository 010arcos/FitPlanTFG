@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Contenedor principal con el mensaje de bienvenida y las tarjetas -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl p-8">
            <div class="text-center">
                <!-- Título -->
               <h2 class="text-4xl font-extrabold text-teal-600 mb-6">
                    ¡Bienvenido {{ Auth::user()->name }}!
                </h2>

                <!-- Mensaje breve -->
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-10">
                    Gestión de Usuarios, Dietas y Ejercicios
                </p>

                <!-- Contenedor de tarjetas -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                    <!-- Tarjeta de Usuarios -->
                    <div
                        class="bg-gray-800 p-6 rounded-xl shadow-2xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-105">
                        <h3 class="text-3xl font-bold text-white mb-4">Usuarios</h3>
                        <p class="text-gray-300 mb-6">Gestiona los usuarios registrados en el sistema.</p>
                        <a href="{{ route('administracion.usuarios.index') }}"
                            class="bg-teal-600 text-white px-8 py-4 rounded-lg hover:bg-teal-700 transition duration-300 ease-in-out shadow-sm transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 w-full block text-center">
                            Ver Usuarios
                        </a>
                    </div>

                    <!-- Tarjeta de Dietas -->
                    <div
                        class="bg-gray-800 p-6 rounded-xl shadow-2xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-105">
                        <h3 class="text-3xl font-bold text-white mb-4">Dietas</h3>
                        <p class="text-gray-300 mb-6">Accede y edita las dietas disponibles para los usuarios.</p>
                        <a href="{{ route('administracion.dietas.index') }}"
                            class="bg-teal-600 text-white px-8 py-4 rounded-lg hover:bg-teal-700 transition duration-300 ease-in-out shadow-sm transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 w-full block text-center">
                            Ver Dietas
                        </a>
                    </div>

                    <!-- Tarjeta de Comidas -->
                    <div
                        class="bg-gray-800 p-6 rounded-xl shadow-2xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-105">
                        <h3 class="text-3xl font-bold text-white mb-4">Comidas</h3>
                        <p class="text-gray-300 mb-6">Consulta las comidas asociadas a las dietas de los usuarios.</p>
                        <a href="{{ route('administracion.comidas.index') }}"
                            class="bg-teal-600 text-white px-8 py-4 rounded-lg hover:bg-teal-700 transition duration-300 ease-in-out shadow-sm transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 w-full block text-center">
                            Ver Comidas
                        </a>
                    </div>
                </div> <!-- Fin del contenedor de tarjetas -->
            </div>
        </div>
    </div>
</div>
@endsection