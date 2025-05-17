<h1 class="text-2xl font-bold mb-6 text-gray-800">
    {{ $Modo == 'crear' ? 'Agregar Ejercicios' : 'Modificar Ejercicios' }}
</h1>
<br>

<form action="{{ $Modo == 'crear' ? url('ejercicios') : url('ejercicios/'.$ejercicio->id_ejercicio) }}" method="POST"
    class="w-[500px] mx-auto p-6 bg-white shadow-md rounded-lg">
    @csrf
    @if($Modo == 'editar')
    @method('PUT')
    @endif

    <!-- nombre -->
    <div class="mb-6">
        <label for="nombre" class="block text-gray-700 text-sm font-medium">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $ejercicio->nombre ?? '') }}"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('nombre') ? 'is-invalid' : '' }}">
        {!! $errors->first('nombre', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Descripcion -->
    <div class="mb-6">
        <label for="descripcion" class="block text-gray-700 text-sm font-medium">Descripción</label>
        <textarea name="descripcion" id="descripcion" rows="3"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('descripcion') ? 'is-invalid' : '' }}">{{ old('descripcion', $ejercicio->descripcion ?? '') }}</textarea>
        {!! $errors->first('descripcion', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>
    <!-- Zona (desplegable) -->
    <div class="mb-6">
        <label for="zona" class="block text-gray-700 text-sm font-medium">Zona</label>
        <select name="zona" id="zona"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('zona') ? 'is-invalid' : '' }}">
            <option value="">Selecciona una zona</option>
            <option value="pecho" {{ old('zona', $ejercicio->zona ?? '') == 'pecho' ? 'selected' : '' }}>Pecho</option>
            <option value="espalda" {{ old('zona', $ejercicio->zona ?? '') == 'espalda' ? 'selected' : '' }}>Espalda
            </option>
            <option value="pierna" {{ old('zona', $ejercicio->zona ?? '') == 'pierna' ? 'selected' : '' }}>Pierna
            </option>
            <option value="hombro" {{ old('zona', $ejercicio->zona ?? '') == 'hombro' ? 'selected' : '' }}>Hombros
            </option>
        </select>
        {!! $errors->first('zona', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Tipo (desplegable) -->
    <div class="mb-6">
        <label for="tipo" class="block text-gray-700 text-sm font-medium">Tipo</label>
        <select name="tipo" id="tipo"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('tipo') ? 'is-invalid' : '' }}">
            <option value="">Selecciona un tipo</option>
            <option value="fuerza" {{ old('tipo', $ejercicio->tipo ?? '') == 'fuerza' ? 'selected' : '' }}>Fuerza
            </option>
            <option value="cardio" {{ old('tipo', $ejercicio->tipo ?? '') == 'cardio' ? 'selected' : '' }}>Cardio
            </option>
            <option value="flexibilidad" {{ old('tipo', $ejercicio->tipo ?? '') == 'flexibilidad' ? 'selected' : ''
                }}>Flexibilidad</option>
            <option value="equilibrio" {{ old('tipo', $ejercicio->tipo ?? '') == 'equilibrio' ? 'selected' : ''
                }}>Equilibrio</option>
            <option value="resistencia" {{ old('tipo', $ejercicio->tipo ?? '') == 'resistencia' ? 'selected' : ''
                }}>Resistencia</option>
            <option value="hipertrofia" {{ old('tipo', $ejercicio->tipo ?? '') == 'hipertrofia' ? 'selected' : ''
                }}>Hipertrofia</option>
            <option value="funcional" {{ old('tipo', $ejercicio->tipo ?? '') == 'funcional' ? 'selected' : ''
                }}>Funcional
            </option>
        </select>
        {!! $errors->first('tipo', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>













    <!-- Botones -->
    <div class="flex justify-between mt-4">
        <button type="submit"
            class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">Guardar</button>
        <a href="{{url('administracion/ejercicios')}}"
            class="inline-block bg-gray-300 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-400 transition duration-300">Volver</a>
    </div>
    </div>
</form>