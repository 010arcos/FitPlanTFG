
@extends('layouts.app')

@section('content')
<div class="container">

<!--
@if(count($errors)>0) Por defecto el validate nos envia un array de errores
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>

        @endforeach
    </ul>

</div>
@endif
-->
<form action="{{ route('administracion.dietas.guardar') }}"  method="post" class="w-[500px] mx-auto p-6 bg-white shadow-md rounded-lg">
    @csrf 
    @include('administracion.dietas.form', ['Modo' => 'crear'])



    
</form>
</div>
@endsection