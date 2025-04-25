@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Plan Semanal de Comidas</h1>

    <table class="w-full table-auto bg-white shadow-md rounded-lg overflow-hidden text-center">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2">Comida</th>
                <th class="px-4 py-2">Lunes</th>
                <th class="px-4 py-2">Martes</th>
                <th class="px-4 py-2">Miércoles</th>
                <th class="px-4 py-2">Jueves</th>
                <th class="px-4 py-2">Viernes</th>
                <th class="px-4 py-2">Sábado</th>
                <th class="px-4 py-2">Domingo</th>
            </tr>
        </thead>
        <tbody class="text-gray-800">
            <tr class="border-t">
                <td class="px-4 py-2 font-semibold">Desayuno</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2 font-semibold">Almuerzo</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2 font-semibold">Comida</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2 font-semibold">Merienda</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2 font-semibold">Cena</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">-</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-6 text-right">
        <a href="{{ route('administracion.comidas.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Agregar nueva comida</a>
    </div>
</div>
@endsection