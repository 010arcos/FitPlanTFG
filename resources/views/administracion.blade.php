@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Título -->
                    <h2 class="text-3xl font-semibold text-teal-600 mb-4">
                        ¡Bienvenido {{ Auth::user()->name }}!
                    </h2>

                    <!-- Mensaje breve -->
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                        Gestion de Usuarios, Dietas y Ejercicios
                    </p>

                    <!-- Contenedor de botones -->
                    <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                        <!-- Enlace a Usuarios -->
                        <a href="{{ route('administracion.usuarios.index') }}" class="bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 transition duration-300 ease-in-out shadow-sm transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 text-center">
                            Ver Usuarios
                        </a>

                         <!-- Enlace a Usuarios -->
                         <a href="{{ route('administracion.dietas.index') }}" class="bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 transition duration-300 ease-in-out shadow-sm transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 text-center">
                            Ver Dietas
                        </a>

                        <!-- Enlace a Usuarios -->
                        <a href="{{ route('administracion.comidas.index') }}" class="bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 transition duration-300 ease-in-out shadow-sm transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 text-center">
                            Ver Comidas
                        </a>

                      
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
