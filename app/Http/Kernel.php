<?php

// namespace App\Http;

// use Illuminate\Foundation\Http\Kernel as HttpKernel;

// class Kernel extends HttpKernel
// {
//     /**
//      * The application's global HTTP middleware stack.
//      *
//      * @var array
//      */
//     protected $middleware = [];

//     /**
//      * The application's route middleware groups.
//      *
//      * @var array
//      */
//     protected $middlewareGroups = [
//         'web' => [
//             // Estos son esenciales para el funcionamiento básico de la web
//             \Illuminate\Session\Middleware\StartSession::class,
//             \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//         ],
//         'api' => [],
//     ];

//     /**
//      * The application's middleware aliases.
//      *
//      * @var array
//      */
//     protected $middlewareAliases = [
//         // Middlewares de autenticación que existen en tu proyecto
//         'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
//         'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
//         'can' => \Illuminate\Auth\Middleware\Authorize::class,
//         'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
//         'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
//         'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,

//         // Tu middleware personalizado con namespace completo
//         'admin' => \App\Http\Middleware\AdminRoleMiddleware::class,
//     ];
// }
