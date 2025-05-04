@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-50 shadow-lg rounded-lg max-w-2xl">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">{{ $dieta->id_dieta }} - {{ $dieta->nombre }}</h1>

    @if ($errors->has('comidas'))
    <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
        <ul>
            <li>{{ $errors->first('comidas') }}</li>
        </ul>
    </div>
    @endif

    <form action="{{ route('administracion.dietas.guardar.comida', ['id' => $dieta->id_dieta]) }}" method="POST"
        class="w-full mx-auto p-6 bg-white shadow-md rounded-lg">
        @csrf

        <!-- Inputs para comidas -->
        @foreach (['desayuno', 'almuerzo', 'comida', 'merienda', 'cena'] as $tipo)
        <div class="mb-6">
            <label for="{{ $tipo }}" class="block text-gray-700 font-bold mb-2">{{ ucfirst($tipo) }}</label>
            <div class="relative">
                <button type="button"
                    class="w-full text-left px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 flex justify-between items-center"
                    onclick="toggleDetails('{{ $tipo }}-details')">
                    <span id="{{ $tipo }}-button-text">
                        @php
                        $comidaAsignada = $comidasDieta->first(function($comida) use ($tipo) {
                        return $comida->pivot && $comida->pivot->tipo_comida === $tipo;
                        });
                        @endphp
                       {{ $comidaAsignada ? $comidaAsignada->nombre . ' ID: ' . $comidaAsignada->id_comida . '' : 'Selecciona una comida para
                    ' . ucfirst($tipo) }}
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div id="{{ $tipo }}-details"
                    class="hidden mt-2 p-4 bg-white shadow rounded-lg max-h-60 overflow-y-auto">
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach ($comidas as $comida)
                        <li class="flex justify-between items-center py-1 hover:bg-gray-50">
                            <span>{{ $comida->nombre }} ({{ $comida->calorias }} Calorías)</span>
                            <input type="radio" name="comidas[{{ $tipo }}]" value="{{ $comida->id_comida }}"
                                class="ml-4" @php $comidaAsignada=$comidasDieta->first(function($c) use ($tipo, $comida)
                            {
                            return $c->pivot && $c->pivot->tipo_comida === $tipo && $c->id_comida ===
                            $comida->id_comida;
                            });
                            @endphp
                            {{ $comidaAsignada ? 'checked' : '' }}
                            onclick="selectComida('{{ $tipo }}', '{{ $comida->id_comida }}', '{{ $comida->nombre }}', {{
                            json_encode([
                            'ingredientes' => json_decode($comida->alimentos)->ingredientes,
                            'calorias' => $comida->calorias,
                            'macros' => json_decode($comida->macros)
                            ]) }})">
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Campo oculto para enviar el ID de la comida seleccionada -->
                @php
                $comidaAsignada = $comidasDieta->first(function($comida) use ($tipo) {
                return $comida->pivot && $comida->pivot->tipo_comida === $tipo;
                });
                $comidaId = $comidaAsignada ? $comidaAsignada->id_comida : old("comidas.$tipo", '');
                @endphp
                <input type="hidden" id="{{ $tipo }}-input" name="comidas[{{ $tipo }}]" value="{{ $comidaId }}">

                <!-- Mostrar errores específicos para cada tipo de comida -->
                @error("comidas.$tipo")
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Sección para mostrar/ocultar detalles -->
                <div id="{{ $tipo }}-details-section"
                    class="{{ $comidaAsignada ? '' : 'hidden' }} mt-4 p-4 bg-gray-100 border rounded-lg text-gray-700">
                    @if($comidaAsignada)
                    @php
                    $alimentos = json_decode($comidaAsignada->alimentos);
                    $macros = json_decode($comidaAsignada->macros);
                    @endphp
                    <p><strong>Alimentos:</strong></p>
                    <ul>
                        @foreach($alimentos->ingredientes as $ing)
                        <li>{{ $ing->nombre }}: {{ $ing->cantidad }}</li>
                        @endforeach
                    </ul>
                    <p><strong>Calorías:</strong> {{ $comidaAsignada->calorias }}</p>
                    <p><strong>Macros:</strong> Proteínas: {{ $macros->proteinas }}g, Carbohidratos: {{
                        $macros->carbohidratos }}g, Grasas: {{ $macros->grasas }}g</p>
                    @endif
                </div>
                <a href="javascript:void(0);" class="text-blue-500 underline mt-2 inline-block"
                    onclick="toggleDetailsSection('{{ $tipo }}-details-section')">Mostrar/Ocultar detalles</a>
            </div>
        </div>
        @endforeach

        <div class="text-center mt-6">
            <button type="submit"
                class="px-6 py-2 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Guardar
            </button>
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
        const button = document.getElementById(`${tipo}-button-text`);
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
    
    // Inicializar los detalles para comidas ya seleccionadas
    document.addEventListener('DOMContentLoaded', function() {
        ['desayuno', 'almuerzo', 'comida', 'merienda', 'cena'].forEach(tipo => {
            const hiddenInput = document.getElementById(`${tipo}-input`);
            if (hiddenInput.value) {
                const detailsSection = document.getElementById(`${tipo}-details-section`);
                if (detailsSection && !detailsSection.classList.contains('hidden')) {
                    // Ya hay contenido, no necesitamos hacer nada
                }
            }
        });
    });
</script>
@endsection