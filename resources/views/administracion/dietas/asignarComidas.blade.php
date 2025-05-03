@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6 bg-gray-50 shadow-lg rounded-lg max-w-2xl">
   

    <h1 class="text-2xl font-bold mb-6 text-gray-800">{{ $dieta->id_dieta }} - {{ $dieta->nombre }}</h1>

    @if ($errors->has('comidas'))
    <div class="alert alert-danger" role="alert">
        <ul>
            <li>{{ $errors->first('comidas') }}</li>
        </ul>
    </div>
    @endif

    <form action="{{ route('administracion.dietas.guardar.comida', ['id' => $dieta->id_dieta]) }}" method="POST"
        class="w-[500px] mx-auto p-6 bg-white shadow-md rounded-lg">
        @csrf

        <!-- Inputs para comidas -->
        @foreach (['desayuno', 'almuerzo', 'comida', 'merienda', 'cena'] as $tipo)
        <div class="grid grid-cols-1 gap-4">
            <label for="{{ $tipo }}" class="block text-gray-700 font-bold">{{ ucfirst($tipo) }}</label>
            <div class="relative">
                <button type="button"
                    class="w-full text-left px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 flex justify-between items-center"
                    onclick="toggleDetails('{{ $tipo }}-details')">
                    <span>Selecciona una comida para {{ ucfirst($tipo) }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="{{ $tipo }}-details" class="hidden mt-2 p-4 bg-white shadow rounded-lg">
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach ($comidas as $comida)
                        <li class="flex justify-between items-center">
                            <span>{{ $comida->nombre }} ({{ $comida->calorias }} Calorías)</span>
                            <input type="radio" name="comidas[{{ $tipo }}]" value="{{ $comida->id_comida }}"
                                class="ml-4" {{ old("comidas.$tipo")==$comida->id_comida ? 'checked' : '' }}
                            onclick="selectComida('{{ $tipo }}', '{{ $comida->id_comida }}', '{{ $comida->nombre }}', {{
                            json_encode(['ingredientes' => json_decode($comida->alimentos)->ingredientes, 'calorias' =>
                            $comida->calorias, 'macros' => json_decode($comida->macros)]) }})">
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Campo oculto para enviar el ID de la comida seleccionada -->
                <input type="hidden" id="{{ $tipo }}-input" name="comidas[{{ $tipo }}]"
                    value="{{ old('comidas.' . $tipo) }}">

                <!-- Mostrar errores específicos para cada tipo de comida -->
                @error("comidas.$tipo")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Sección para mostrar/ocultar detalles -->
                <div id="{{ $tipo }}-details-section"
                    class="hidden mt-4 p-4 bg-gray-100 border rounded-lg text-gray-700">
                    <!-- Detalles dinámicos -->
                </div>
                <a href="javascript:void(0);" class="text-blue-500 underline"
                    onclick="toggleDetailsSection('{{ $tipo }}-details-section')">Mostrar/Ocultar detalles</a>
            </div>
        </div>
        @endforeach

        <div class="text-center">
            <button type="submit"
                class="px-6 py-2 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Guardar</button>
        </div>
    </form>
</div>

<script>
    function toggleDetails(id) {
        const element = document.getElementById(id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    }

    function toggleDetailsSection(id) {
        const section = document.getElementById(id);
        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
        } else {
            section.classList.add('hidden');
        }
    }

    function selectComida(tipo, comidaId, comidaNombre, comidaDetalles) {
        const button = document.querySelector(`button[onclick="toggleDetails('${tipo}-details')"] span`);
        button.textContent = comidaNombre;
        toggleDetails(`${tipo}-details`);

        // Actualizar detalles dinámicos
        const detailsSection = document.getElementById(`${tipo}-details-section`);
        detailsSection.innerHTML = ` 
            <p><strong>Alimentos:</strong></p>
            <ul>
                ${comidaDetalles.ingredientes.map(ing => `<li>${ing.nombre}: ${ing.cantidad}</li>`).join('')}
            </ul>
            <p><strong>Calorías:</strong> ${comidaDetalles.calorias}</p>
            <p><strong>Macros:</strong> Proteínas: ${comidaDetalles.macros.proteinas}g, Carbohidratos: ${comidaDetalles.macros.carbohidratos}g, Grasas: ${comidaDetalles.macros.grasas}g</p>
        `;
        detailsSection.classList.remove('hidden');

        // Actualizar campo oculto con el ID y tipo de comida
        const hiddenInput = document.getElementById(`${tipo}-input`);
        hiddenInput.value = comidaId;
    }
</script>

@endsection