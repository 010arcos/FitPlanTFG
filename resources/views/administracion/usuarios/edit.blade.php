@extends('layouts.app')

@section('content')
<div class="container">




    @if(session('error'))
    <div class="alert alert-danger" style="max-width: 400px; margin: 20px auto;" role="alert">
        {{ session('error') }}
    </div>
    @endif

    @if(Session::has('Mensaje')){{
    Session::get('Mensaje')
    }}
    @endif

    <form action="{{ route('administracion.usuarios.update', $usuario->id) }}" method="post"
        class="w-[500px] mx-auto p-6 bg-white shadow-md rounded-lg">
        @csrf
        @method('PATCH')
        <!-- Aquí pasas el método PATCH -->

        @include('administracion.usuarios.form', ['Modo' => 'editar'])
        <!--a form y q me aparezca el mensaje de oq  es -->


    </form>
</div>
@endsection