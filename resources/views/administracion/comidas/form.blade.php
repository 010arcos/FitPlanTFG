<h1 class="text-2xl font-bold mb-6 text-gray-800">
    {{ $Modo == 'crear' ? 'Agregar comidas' : 'Modificar comidas' }}
</h1>
<br>

<form action="{{ $Modo == 'crear' ? url('comidas') : url('comidas/'.$comida->id_comida) }}" method="POST"
    class="w-[500px] mx-auto p-6 bg-white shadow-md rounded-lg">
    @csrf
    @if($Modo == 'editar')
    @method('PUT')
    @endif

    <!-- nombre -->
    <div class="mb-6">
        <label for="nombre" class="block text-gray-700 text-sm font-medium">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $comida->nombre ?? '') }}"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('nombre') ? 'is-invalid' : '' }}">
        {!! $errors->first('nombre', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Calorias -->
    <div class="mb-6">
        <label for="calorias" class="block text-gray-700 text-sm font-medium">Calorías</label>
        <input type="number" name="calorias" id="calorias" step="1"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('calorias') ? 'is-invalid' : '' }}"
            value="{{ old('calorias', $comida->calorias ?? '') }}">
        {!! $errors->first('calorias', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Macro de Comida (Proteínas, Carbohidratos y Grasas) -->
    <div id="macros" class="mb-6">
        <label for="macros" class="block text-gray-700 text-sm font-medium">Macros</label>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="proteinas" class="block text-gray-700 text-sm font-medium">Proteínas (g)</label>
                <input type="number" name="proteinas" id="proteinas"
                    value="{{ old('proteinas', $macros['proteinas'] ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('proteinas') ? 'is-invalid' : '' }}">
                {!! $errors->first('proteinas', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>
                ') !!}
            </div>

            <div>
                <label for="carbohidratos" class="block text-gray-700 text-sm font-medium">Carbohidratos (g)</label>
                <input type="number" name="carbohidratos" id="carbohidratos"
                    value="{{ old('carbohidratos', $macros['carbohidratos'] ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('carbohidratos') ? 'is-invalid' : '' }}">
                {!! $errors->first('carbohidratos', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message
                </div>') !!}
            </div>

            <div>
                <label for="grasas" class="block text-gray-700 text-sm font-medium">Grasas (g)</label>
                <input type="number" name="grasas" id="grasas" value="{{ old('grasas', $macros['grasas'] ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('grasas') ? 'is-invalid' : '' }}">
                {!! $errors->first('grasas', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>')
                !!}
            </div>
        </div>
    </div>

    @php
    $ingredientesArray = [];
    if (isset($comida) && !empty($comida->alimentos)) {
    $decoded = json_decode($comida->alimentos, true);
    $ingredientesArray = $decoded['ingredientes'] ?? [];
    }
    $contadorInicial = count($ingredientesArray);
    @endphp

    <!-- Alimentos (Ingredientes) -->
    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-medium mb-2">Ingredientes</label>
        <div id="ingredientes-container" class="space-y-4">
            @php
            $ingredientesOld = old('ingredientes', $ingredientesArray);
            @endphp

            @foreach($ingredientesOld as $index => $ingrediente)
            <div class="flex space-x-4 items-center">
                <div class="w-1/2">
                    <input type="text" name="ingredientes[{{ $index }}][nombre]" placeholder="Ingrediente"
                        value="{{ old('ingredientes.' . $index . '.nombre', $ingrediente['nombre']) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('ingredientes.' . $index . '.nombre') ? 'is-invalid' : '' }}">
                    {!! $errors->first('ingredientes.' . $index . '.nombre', '<div
                        class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
                </div>
                <div class="w-1/2">
                    <input type="text" name="ingredientes[{{ $index }}][cantidad]" placeholder="Cantidad"
                        value="{{ old('ingredientes.' . $index . '.cantidad', $ingrediente['cantidad']) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('ingredientes.' . $index . '.cantidad') ? 'is-invalid' : '' }}">
                    {!! $errors->first('ingredientes.' . $index . '.cantidad', '<div
                        class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
                </div>
                <button type="button" onclick="this.parentElement.remove()"
                    class="ml-2 text-red-500 hover:text-red-700 font-bold text-lg">&times;</button>
            </div>
            @endforeach
        </div>

        <button type="button" onclick="agregarIngrediente()"
            class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
            + Agregar otro ingrediente
        </button>
    </div>

    <!-- Botones -->
    <div class="flex justify-between mt-4">
        <button type="submit"
            class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">Guardar</button>
        <a href="{{url('administracion/comidas')}}"
            class="inline-block bg-gray-300 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-400 transition duration-300">Volver</a>
    </div>
</form>
<script>
    let contadorIngredientes = {{ $contadorInicial ?? 1 }};
    
    function agregarIngrediente() {
    const container = document.getElementById('ingredientes-container');A
    
    const div = document.createElement('div');
    div.classList.add('flex', 'space-x-4', 'items-center');
    
    div.innerHTML = `
    <input type="text" name="ingredientes[${contadorIngredientes}][nombre]" placeholder="Ingrediente"
        class="w-1/2 px-4 py-2 border border-gray-300 rounded-md shadow-sm">
    <input type="text" name="ingredientes[${contadorIngredientes}][cantidad]" placeholder="Cantidad"
        class="w-1/2 px-4 py-2 border border-gray-300 rounded-md shadow-sm">
    <button type="button" onclick="this.parentElement.remove()"
        class="ml-2 text-red-500 hover:text-red-700 font-bold text-lg">&times;</button>
    `;
    
    container.appendChild(div);
    contadorIngredientes++;
    }
</script>