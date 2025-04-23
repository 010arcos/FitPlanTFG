<h1 class="text-2xl font-bold mb-6 text-gray-800">
    {{ $Modo == 'crear' ? 'Agregar usuarios' : 'Modificar usuarios' }}
</h1>
<br>

<form action="{{ $Modo == 'crear' ? url('usuarios') : url('usuarios/'.$usuario->id) }}" method="POST" class="w-[500px] mx-auto p-6 bg-white shadow-md rounded-lg">
    @csrf
    @if($Modo == 'editar')
        @method('PUT')
    @endif

    <!-- Nombre -->
    <div class="mb-6">
        <label for="name" class="block text-gray-700 text-sm font-medium">Nombre</label>
        <input type="text" name="name" id="name"
               value="{{ old('name', $usuario->name ?? '') }}"
               class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('name') ? 'is-invalid' : '' }}">
        {!! $errors->first('name', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Apellido -->
    <div class="mb-6">
        <label for="apellido" class="block text-gray-700 text-sm font-medium">Apellido</label>
        <input type="text" name="apellido" id="apellido"
               value="{{ old('apellido', $usuario->apellido ?? '') }}"
               class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('apellido') ? 'is-invalid' : '' }}">
        {!! $errors->first('apellido', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Email -->
    <div class="mb-6">
        <label for="email" class="block text-gray-700 text-sm font-medium">Email</label>
        <input type="email" name="email" id="email"
               value="{{ old('email', $usuario->email ?? '') }}"
               class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('email') ? 'is-invalid' : '' }}">
        {!! $errors->first('email', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Contraseña (solo en crear) -->
    @if($Modo == 'crear')
    <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-medium">Contraseña</label>
        <input type="password" name="password" id="password"
               class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('password') ? 'is-invalid' : '' }}">
        {!! $errors->first('password', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>
    @endif

    <!-- Edad -->
    <div class="mb-6">
        <label for="edad" class="block text-gray-700 text-sm font-medium">Edad</label>
        <input type="number" name="edad" id="edad" min="0"
               value="{{ old('edad', $usuario->edad ?? '') }}"
               class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('edad') ? 'is-invalid' : '' }}">
        {!! $errors->first('edad', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Altura -->
    <div class="mb-6">
        <label for="altura" class="block text-gray-700 text-sm font-medium">Altura</label>
        <input type="number" name="altura" id="altura" step="0.01"
               value="{{ old('altura', $usuario->altura ?? '') }}"
               class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('altura') ? 'is-invalid' : '' }}">
        {!! $errors->first('altura', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Género -->
    <div class="mb-6">
        <label for="genero" class="block text-gray-700 text-sm font-medium">Género</label>
        <select name="genero" id="genero"
                class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('genero') ? 'is-invalid' : '' }}">
            <option value="">Selecciona...</option>
            <option value="Masculino" {{ old('genero', $usuario->genero ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="Femenino" {{ old('genero', $usuario->genero ?? '') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
            <option value="Otro" {{ old('genero', $usuario->genero ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
        </select>
        {!! $errors->first('genero', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Activo -->
    <div class="mb-6">
        <label for="activo" class="block text-gray-700 text-sm font-medium">Activo</label>
        <select name="activo" id="activo"
                class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm">
            <option value="1" {{ old('activo', $usuario->activo ?? '') == '1' ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ old('activo', $usuario->activo ?? '') == '0' ? 'selected' : '' }}>No</option>
        </select>
        {!! $errors->first('activo', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Peso -->
    <div class="mb-6">
        <label for="peso" class="block text-gray-700 text-sm font-medium">Peso</label>
        <input type="number" name="peso" id="peso" step="0.1"
               value="{{ old('peso', $usuario->peso ?? '') }}"
               class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm {{ $errors->has('peso') ? 'is-invalid' : '' }}">
        {!! $errors->first('peso', '<div class="invalid-feedback text-red-500 text-sm mt-1">:message</div>') !!}
    </div>

    <!-- Botones -->
    <div class="flex justify-between mt-4">
        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300">Guardar</button>
        <a href="{{url('administracion/usuarios')}}" class="inline-block bg-gray-300 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-400 transition duration-300">Volver</a>
    </div>
</form>
