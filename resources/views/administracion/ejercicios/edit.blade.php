@extends('layouts.app')

@section('content')
<div class="container">




    <!--@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>

        @endforeach
    </ul>

</div>
@endif
@if(Session::has('Mensaje')){{ 
    Session::get('Mensaje')
}}
@endif
-->
    <form action="{{ route('administracion.ejercicios.update', $ejercicio->id_ejercicio) }}" method="post"
        class="w-[500px] mx-auto p-6 bg-white shadow-md rounded-lg">
        @csrf
        @method('PATCH')
        <!-- Aquí pasas el método PATCH -->

        @include('administracion.ejercicios.form', ['Modo' => 'editar'])
        <!--a form y q me aparezca el mensaje de oq  es -->


    </form>
</div>
@endsection