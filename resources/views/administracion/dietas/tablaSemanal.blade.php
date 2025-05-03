@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-50 shadow-lg rounded-lg mb-8">
    <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">Dietas Asignadas</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($comidasPorDieta as $dietaId => $comidas)
        @if ($comidas->isNotEmpty())
        <div class="p-4 bg-white shadow-md rounded-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Dieta ID: {{ $dietaId }}</h3>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                @foreach ($comidas as $comida)
                <option value="{{ $comida->id_comida }}">{{ $comida->nombre }} ({{ ucfirst($comida->pivot->tipo_comida)
                    }})</option>
                @endforeach
            </select>
        </div>
        @endif
        @endforeach
    </div>
</div>

<div class="container mx-auto p-6 bg-gray-50 shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Plan Semanal de Comidas</h1>

    <table class="w-full table-auto border-collapse bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="px-6 py-3 text-left">Comida</th>
                <th class="px-6 py-3">Lunes</th>
                <th class="px-6 py-3">Martes</th>
                <th class="px-6 py-3">Miércoles</th>
                <th class="px-6 py-3">Jueves</th>
                <th class="px-6 py-3">Viernes</th>
                <th class="px-6 py-3">Sábado</th>
                <th class="px-6 py-3">Domingo</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach (['desayuno', 'almuerzo', 'comida', 'merienda', 'cena'] as $tipoComida)
            <tr class="border-t border-gray-200 hover:bg-gray-100">
                <td class="px-6 py-4 font-semibold text-gray-800">{{ ucfirst($tipoComida) }}</td>
                @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                <td class="px-6 py-4 text-center">
                    @php
                    $comida = $comidasPorDieta->flatMap(fn($comidas) => $comidas)->firstWhere('pivot.tipo_comida',
                    $tipoComida);
                    @endphp
                    <span class="block text-sm font-medium">{{ $comida ? $comida->nombre : '-' }}</span>
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    {{--
    <div class="mt-8 text-right">
        <a href="{{ route('administracion.comidas.create') }}"
            class="inline-block bg-green-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-600 transition duration-300">
            + Agregar nueva comida
        </a>
    </div> --}}
</div>
@endsection