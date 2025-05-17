<form action="{{ $Modo == 'crear' ? url('usuarios') : url('usuarios/'.$usuario->id) }}" method="POST"
    class="max-w-4xl mx-auto p-6 bg-gradient-to-r from-blue-50 to-blue-100 shadow-lg rounded-lg border border-blue-200">
    @csrf
    @if($Modo == 'editar')
    @method('PUT')
    @endif
    <!-- Datos Personales -->
    <div class="mb-8">
        <h2
            class="text-xl font-bold text-blue-700 bg-blue-200 px-4 py-2 rounded-lg mb-5 flex items-center gap-3 border-l-4 border-blue-600">
            Datos Personales
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Nombre -->
            <div>
                <label for="name" class="block text-lg font-medium text-gray-800">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $usuario->name ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 {{ $errors->has('name') ? 'is-invalid' : '' }}">
                {!! $errors->first('name', '<div class="text-red-500 text-sm mt-2">:message</div>') !!}
            </div>
            <!-- Apellido -->
            <div>
                <label for="apellido" class="block text-lg font-medium text-gray-800">Apellido</label>
                <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $usuario->apellido ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 {{ $errors->has('apellido') ? 'is-invalid' : '' }}">
                {!! $errors->first('apellido', '<div class="text-red-500 text-sm mt-2">:message</div>') !!}
            </div>
            <!-- Email -->
            <div>
                <label for="email" class="block text-lg font-medium text-gray-800">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $usuario->email ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 {{ $errors->has('email') ? 'is-invalid' : '' }}">
                {!! $errors->first('email', '<div class="text-red-500 text-sm mt-2">:message</div>') !!}
            </div>
            <!-- Password -->
            <div>
                <label for="password" class="block text-lg font-medium text-gray-800">Contraseña</label>
                <input type="password" name="password" id="password"
                    value="{{ old('password', $usuario->password ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 {{ $errors->has('password') ? 'is-invalid' : '' }}">
                {!! $errors->first('password', '<div class="text-red-500 text-sm mt-2">:message</div>') !!}
            </div>
            <!-- Género -->
            <div>
                <label for="genero" class="block text-lg font-medium text-gray-800">Género</label>
                <select name="genero" id="genero"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 {{ $errors->has('genero') ? 'is-invalid' : '' }}">
                    <option value="">Selecciona...</option>
                    <option value="Masculino" {{ old('genero', $usuario->genero ?? '') == 'Masculino' ? 'selected' : ''
                        }}>Masculino</option>
                    <option value="Femenino" {{ old('genero', $usuario->genero ?? '') == 'Femenino' ? 'selected' : ''
                        }}>Femenino</option>
                    <option value="Otro" {{ old('genero', $usuario->genero ?? '') == 'Otro' ? 'selected' : '' }}>Otro
                    </option>
                </select>
                {!! $errors->first('genero', '<div class="text-red-500 text-sm mt-2">:message</div>') !!}
            </div>
            <!-- Activo -->
            <div>
                <label for="activo" class="block text-lg font-medium text-gray-800">Activo</label>
                <select name="activo" id="activo"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                    <option value="1" {{ old('activo', $usuario->activo ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ old('activo', $usuario->activo ?? '') == '0' ? 'selected' : '' }}>No</option>
                </select>
                {!! $errors->first('activo', '<div class="text-red-500 text-sm mt-2">:message</div>') !!}
            </div>
            <!-- Asignar Dietas -->
            <div class="col-span-full mb-8">
                <label class="block text-lg font-medium text-gray-800 mb-3">Asignar Dietas</label>
                <div id="dietas-container" class="space-y-6">
                    @if(isset($dietasAsociadas) && count($dietasAsociadas) > 0)
                    @foreach($dietasAsociadas as $dietaId)
                    <div class="flex space-x-6 items-center w-full">
                        <div class="relative w-8/12">
                            <input type="text"
                                class="search-dieta flex-grow px-4 py-2 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-300"
                                value="{{ $dietas->firstWhere('id_dieta', $dietaId)->id_dieta }} - {{ $dietas->firstWhere('id_dieta', $dietaId)->nombre ?? 'Dieta no encontrada' }}"
                                readonly>
                        </div>
                        <input type="hidden" name="dietas[]" value="{{ $dietaId }}">
                        <button type="button" onclick="this.parentElement.remove()"
                            class="ml-3 text-red-500 hover:text-red-700 font-bold text-xl">&times;</button>
                    </div>
                    @endforeach
                    @endif
                    <!-- Se eliminó el campo vacío que aparecía por defecto -->
                </div>
                <button type="button" onclick="agregarDieta()"
                    class="mt-6 bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition">
                    + Agregar dieta
                </button>
            </div>
        </div>
    </div>
    <!-- Datos Métricos -->
    <div class="mb-8">
        <h2
            class="text-xl font-bold text-green-700 bg-green-200 px-4 py-2 rounded-lg mb-5 flex items-center gap-3 border-l-4 border-green-600">
            Datos Métricos
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Edad -->
            <div>
                <label for="edad" class="block text-lg font-medium text-gray-800">Edad</label>
                <input type="number" name="edad" id="edad" min="0" value="{{ old('edad', $usuario->edad ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-300 {{ $errors->has('edad') ? 'is-invalid' : '' }}">
                {!! $errors->first('edad', '<div class="text-red-500 text-sm mt-2">:message</div>') !!}
            </div>
            <!-- Altura -->
            <div>
                <label for="altura" class="block text-lg font-medium text-gray-800">Altura (m)</label>
                <input type="number" name="altura" id="altura" step="0.01"
                    value="{{ old('altura', $usuario->altura ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-300 {{ $errors->has('altura') ? 'is-invalid' : '' }}">
                {!! $errors->first('altura', '<div class="text-red-500 text-sm mt-2">:message</div>') !!}
            </div>
            <!-- Peso -->
            <div>
                <label for="peso" class="block text-lg font-medium text-gray-800">Peso (kg)</label>
                <input type="number" name="peso" id="peso" step="0.1" value="{{ old('peso', $usuario->peso ?? '') }}"
                    class="form-control mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-300 {{ $errors->has('peso') ? 'is-invalid' : '' }}">
                {!! $errors->first('peso', '<div class="text-red-500 text-sm mt-2">:message</div>') !!}
            </div>
        </div>
    </div>
    <!-- Botones -->
    <div class="flex justify-between mt-8">
        <button type="submit"
            class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition duration-300 shadow-lg">Guardar</button>
        <a href="{{ url('administracion/usuarios') }}"
            class="bg-gray-400 text-gray-800 px-8 py-4 rounded-lg hover:bg-gray-500 transition duration-300 shadow-lg">Volver</a>
    </div>
</form>

<script>
    function agregarDieta() {
        const container = document.getElementById('dietas-container');
        const div = document.createElement('div');
        div.classList.add('flex', 'space-x-6', 'items-center', 'w-full');
        div.innerHTML = `
            <div class="relative w-8/12">
                <input type="text" class="search-dieta flex-grow px-4 py-2 border border-gray-300 rounded-lg shadow-sm w-full focus:ring focus:ring-blue-300" placeholder="Buscar dieta..." onfocus="mostrarOpciones(this)" oninput="filtrarOpciones(this)">
                <div class="absolute bg-white border border-gray-300 rounded-lg shadow-lg w-full max-h-40 overflow-y-auto hidden" id="opciones-dieta">
                    @foreach($dietas as $dieta)
                    <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer" onclick="seleccionarOpcion(this, '{{ $dieta->id_dieta }} - {{ $dieta->nombre }}', '{{ $dieta->id_dieta }}')">
                        {{ $dieta->id_dieta }} - {{ $dieta->nombre }}
                    </div>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="dietas[]" value="">
            <button type="button" onclick="this.parentElement.remove()" class="ml-3 text-red-500 hover:text-red-700 font-bold text-xl">&times;</button>
        `;
        container.appendChild(div);
    }

    function mostrarOpciones(input) {
        const opciones = input.nextElementSibling;
        opciones.classList.remove('hidden');
    }

    function filtrarOpciones(input) {
        const valor = input.value.toLowerCase();
        const opciones = input.nextElementSibling.querySelectorAll('div');
        opciones.forEach(opcion => {
            if (opcion.textContent.toLowerCase().includes(valor)) {
                opcion.style.display = '';
            } else {
                opcion.style.display = 'none';
            }
        });
    }

    function seleccionarOpcion(opcion, texto, id) {
        const input = opcion.parentElement.previousElementSibling;
        input.value = texto;
        const hiddenInput = opcion.parentElement.parentElement.nextElementSibling;
        hiddenInput.value = id;
        opcion.parentElement.classList.add('hidden');
    }
</script>