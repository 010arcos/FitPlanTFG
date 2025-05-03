@extends('layouts.app')

@section('content')


<div class="container mx-auto p-6 bg-gray-50 shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Plan Semanal de Comidas</h1>

    <!-- Selector de Dieta -->
    <div class="mb-4">
        <label for="dietaSelector" class="block text-gray-700 font-medium mb-2">Selecciona una Dieta:</label>
        <select id="dietaSelector"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300">
            <option value="">Selecciona una dieta</option>
            @foreach ($comidasPorDieta as $dietaId => $comidas)
            <option value="{{ $dietaId }}">Dieta ID: {{ $dietaId }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tabla de Comidas -->
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
        <tbody id="tablaComidas" class="text-gray-700">
            <!-- Contenido dinámico generado por JavaScript -->
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dietaSelector = document.getElementById('dietaSelector');
        const tablaComidas = document.getElementById('tablaComidas');

        // Seleccionar la primera dieta por defecto si existe
        if (dietaSelector.options.length > 1) {
            dietaSelector.selectedIndex = 1; // Selecciona la primera opción después de "Selecciona una dieta"
            const dietaId = dietaSelector.value;

            // Simular el evento de cambio para cargar la tabla
            const event = new Event('change');
            dietaSelector.dispatchEvent(event);
        } else {
            // Si no hay dietas disponibles, mostrar mensaje en la tabla
            const filaVacia = document.createElement('tr');
            filaVacia.innerHTML = '<td colspan="8" class="text-center text-gray-500 py-4">No hay dietas disponibles.</td>';
            tablaComidas.appendChild(filaVacia);
        }
    });

    document.getElementById('dietaSelector').addEventListener('change', function () {
        const dietaId = this.value;
        const tablaComidas = document.getElementById('tablaComidas');

        // Limpiar la tabla
        tablaComidas.innerHTML = '';

        if (dietaId) {
            // Obtener las comidas de la dieta seleccionada
            const comidas = @json($comidasPorDieta);
            const comidasDieta = comidas[dietaId] || [];

            // Tipos de comida y días de la semana
            const tiposComida = ['desayuno', 'almuerzo', 'comida', 'merienda', 'cena'];
            const diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

            // Generar filas dinámicamente
            tiposComida.forEach(tipoComida => {
                const fila = document.createElement('tr');
                fila.classList.add('border-t', 'border-gray-200', 'hover:bg-gray-100');

                // Celda del tipo de comida
                const celdaTipo = document.createElement('td');
                celdaTipo.classList.add('px-6', 'py-4', 'font-semibold', 'text-gray-800');
                celdaTipo.textContent = tipoComida.charAt(0).toUpperCase() + tipoComida.slice(1);
                fila.appendChild(celdaTipo);

                // Celdas de los días de la semana
                diasSemana.forEach(dia => {
                    const celdaDia = document.createElement('td');
                    celdaDia.classList.add('px-6', 'py-4', 'text-center');

                    const comida = comidasDieta.find(c => c.pivot.tipo_comida === tipoComida);
                    if (comida) {
                        const alimentos = JSON.parse(comida.alimentos || '{}');

                        // Modificar el contenido de las celdas para mostrar solo el nombre y los alimentos
                        celdaDia.innerHTML = `
                            <div>
                                <strong>${comida.nombre}</strong>
                                <ul class="text-sm text-gray-600">
                                    ${alimentos.ingredientes.map(ing => `<li>${ing.nombre}: ${ing.cantidad}</li>`).join('')}
                                </ul>
                            </div>
                        `;
                    } else {
                        celdaDia.textContent = '-';
                    }

                    fila.appendChild(celdaDia);
                });

                tablaComidas.appendChild(fila);
            });
        }
    });
</script>
@endsection