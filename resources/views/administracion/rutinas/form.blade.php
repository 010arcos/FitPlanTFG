<h1 class="text-2xl font-bold mb-6 text-gray-800">
    {{ $Modo == 'crear' ? 'Agregar rutinas' : 'Modificar rutinas' }}
</h1>
<br>

<form action="{{ $Modo == 'crear' ? url('rutinas') : url('rutinas/'.$rutina->id_rutina) }}" method="POST"
    class="w-[500px] mx-auto p-6 bg-white shadow-md rounded-lg">
    @csrf
    @if($Modo == 'editar')
    @method('PUT')
    @endif

    <!-- Nombre -->
    <div class="mb-6">
        <label for="nombre" class="block text-gray-700 text-sm font-medium">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $rutina->nombre ?? '') }}"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('nombre') ? 'is-invalid' : '' }}">
        {!! $errors->first('nombre', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Descripción -->
    <div class="mb-6">
        <label for="descripcion" class="block text-gray-700 text-sm font-medium">Descripción</label>
        <textarea name="descripcion" id="descripcion" rows="4"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm resize-y {{ $errors->has('descripcion') ? 'is-invalid' : '' }}">{{ old('descripcion', $rutina->descripcion ?? '') }}</textarea>
        {!! $errors->first('descripcion', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Día de la semana -->
    <div class="mb-6">
        <label for="dia" class="block text-gray-700 text-sm font-medium">Día de la semana</label>
        <select name="dia" id="dia"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('dia') ? 'is-invalid' : '' }}">
            <option value="">Seleccionar día</option>
            <option value="lunes" {{ old('dia', $rutina->dia ?? '') == 'lunes' ? 'selected' : '' }}>Lunes</option>
            <option value="martes" {{ old('dia', $rutina->dia ?? '') == 'martes' ? 'selected' : '' }}>Martes</option>
            <option value="miercoles" {{ old('dia', $rutina->dia ?? '') == 'miercoles' ? 'selected' : '' }}>Miércoles
            </option>
            <option value="jueves" {{ old('dia', $rutina->dia ?? '') == 'jueves' ? 'selected' : '' }}>Jueves</option>
            <option value="viernes" {{ old('dia', $rutina->dia ?? '') == 'viernes' ? 'selected' : '' }}>Viernes</option>

        </select>
        {!! $errors->first('dia', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>


    <!-- Fecha de Inicio -->
    <div class="mb-6">
        <label for="fecha_inicio" class="block text-gray-700 text-sm font-medium">Fecha de Inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio"
            value="{{ old('fecha_inicio', $rutina->fecha_inicio ?? '') }}"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('fecha_inicio') ? 'is-invalid' : '' }}">
        {!! $errors->first('fecha_inicio', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Fecha de Fin -->
    <div class="mb-6">
        <label for="fecha_fin" class="block text-gray-700 text-sm font-medium">Fecha de Fin</label>
        <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $rutina->fecha_fin ?? '') }}"
            class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}">
        {!! $errors->first('fecha_fin', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>




    <!-- Botones -->
    <div class="flex justify-between mt-4">
        <button type="submit"
            class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">Guardar</button>
        <a href="{{url('administracion/rutinas')}}"
            class="inline-block bg-gray-300 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-400 transition duration-300">Volver</a>
    </div>
</form>