<!-- Formulario de medidas -->
<div class="measures-form-container">
    <form action="{{ route('usuario.progreso.store') }}" method="POST" class="measures-form">
        @csrf

        <!-- CONTENEDOR DE 2 COLUMNAS -->
        <div class="data-comparison">
    
            <!-- COLUMNA IZQUIERDA: Datos Actuales -->
            <div class="current-data">
                <h3><i class="fas fa-user"></i> Datos Actuales</h3>
                <div class="data-grid">
                    <div class="data-item">


                        <span class="data-label"><i class="fas fa-weight"></i> Peso actual:</span>
                        <span class="data-value">{{ Auth::user()->peso ?? 'No registrado' }} kg</span>
                    </div>
                    <div class="data-item">


                        <span class="data-label"><i class="fas fa-ruler-vertical"></i> Altura:</span>
                        <span class="data-value">{{ Auth::user()->altura ?? 'No registrada' }} m</span>
                    </div>
                    <div class="data-item">

                        <span class="data-label"><i class="fas fa-calculator"></i> IMC actual:</span>
                        <span class="data-value">
                            @if(Auth::user()->peso && Auth::user()->altura)
                                {{ round(Auth::user()->peso / (Auth::user()->altura * Auth::user()->altura), 2) }}
                            @else

                                No calculado
                            @endif
                        </span>
                    </div>
                </div>
            </div>




            <!-- COLUMNA DERECHA: IMC Nuevo (siempre visible, más ancho) -->
            <div class="imc-preview-section">
                <div class="imc-result-large" x-show="calculatedIMC > 0" x-cloak>
                    <span class="imc-number-large" x-text="calculatedIMC"></span>
                    <span class="imc-status-large" x-text="
                        calculatedIMC < 18.5 ? 'Bajo peso' :
                        calculatedIMC < 25 ? 'Normal' :
                        calculatedIMC < 30 ? 'Sobrepeso' : 'Obesidad'
                    "></span>
                    <div class="imc-label">IMC Nuevo</div>
                </div>
                
                <!-- Placeholder cuando no hay cálculo -->
                <div class="imc-placeholder" x-show="calculatedIMC == 0">
                    <i class="fas fa-calculator"></i>
                    <span>Introduce peso y altura</span>
                </div>
            </div>

        </div>

        <!-- Formulario en grid compacto -->
        <div class="form-compact">
            <h3><i class="fas fa-plus-circle"></i> Nuevo Registro</h3>

            <div class="inputs-row">
                <!-- Solo 3 inputs, SIN IMC -->
                <div class="input-group">
                    <label for="peso"><i class="fas fa-weight"></i> Peso (kg)</label>
                    <input type="number" id="peso" name="peso" step="0.1" min="1" max="500" x-model="formData.peso"
                        @input="calculateIMC()" required>
                    @error('peso')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="input-group">
                    <label for="altura"><i class="fas fa-ruler-vertical"></i> Altura (m)</label>
                    <input type="number" id="altura" name="altura" step="0.01" min="0.5" max="3"
                        x-model="formData.altura" @input="calculateIMC()">
                    @error('altura')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="input-group">
                    <label for="fecha_registro"><i class="fas fa-calendar"></i> Fecha</label>
                    <input type="date" id="fecha_registro" name="fecha_registro" x-model="formData.fecha_registro"
                        required>
                    @error('fecha_registro')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Notas en fila separada pero compacta -->
            <div class="notes-row">
                <label for="notas"><i class="fas fa-sticky-note"></i> Notas</label>
                <textarea id="notas" name="notas" rows="2" placeholder="Observaciones..."
                    x-model="formData.notas"></textarea>
            </div>

            <!-- Botones compactos -->
            <div class="actions-row">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <button type="button" class="btn-secondary" @click="
                    formData.peso = '{{ Auth::user()->peso ?? '' }}';
                    formData.altura = '{{ Auth::user()->altura ?? '' }}';
                    formData.notas = '';
                    calculateIMC();
                ">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>
    </form>
</div>