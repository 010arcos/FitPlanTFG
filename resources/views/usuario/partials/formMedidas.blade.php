<!-- Formulario de medidas -->
<div class="measures-form-container">
    <form action="{{ route('usuario.progreso.store') }}" method="POST" class="measures-form">
        @csrf

        <!-- Datos actuales del usuario -->
        <div class="current-data">
            <h3><i class="fas fa-user"></i> Datos Actuales</h3>
            <div class="data-grid">
                <div class="data-item">
                    <span class="data-label">Peso actual:</span>
                    <span class="data-value">{{ Auth::user()->peso ?? 'No registrado' }} kg</span>
                </div>
                <div class="data-item">
                    <span class="data-label">Altura:</span>
                    <span class="data-value">{{ Auth::user()->altura ?? 'No registrada' }} m</span>
                </div>
                <div class="data-item">
                    <span class="data-label">IMC actual:</span>
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

        <!-- Formulario de nuevo registro -->
        <div class="form-section">
            <h3><i class="fas fa-plus-circle"></i> Nuevo Registro</h3>

            <div class="form-grid">
                <div class="form-group">
                    <label for="peso"><i class="fas fa-weight"></i> Peso (kg)</label>
                    <input type="number" id="peso" name="peso" step="0.1" min="1" max="500" x-model="formData.peso"
                        @input="calculateIMC()" required>
                </div>

                <div class="form-group">
                    <label for="altura"><i class="fas fa-ruler-vertical"></i> Altura (m)</label>
                    <input type="number" id="altura" name="altura" step="0.01" min="0.5" max="3"
                        x-model="formData.altura" @input="calculateIMC()">
                </div>

                <div class="form-group">
                    <label for="fecha_registro"><i class="fas fa-calendar"></i> Fecha</label>
                    <input type="date" id="fecha_registro" name="fecha_registro" x-model="formData.fecha_registro"
                        required>
                </div>
            </div>

            <!-- IMC calculado en tiempo real -->
            <div class="imc-preview" x-show="calculatedIMC > 0">
                <div class="imc-card">
                    <h4><i class="fas fa-calculator"></i> IMC Calculado</h4>
                    <div class="imc-value" x-text="calculatedIMC"></div>
                    <div class="imc-category" x-text="
                        calculatedIMC < 18.5 ? 'Bajo peso' :
                        calculatedIMC < 25 ? 'Normal' :
                        calculatedIMC < 30 ? 'Sobrepeso' : 'Obesidad'
                    "></div>
                </div>
            </div>

            <!-- Notas -->
            <div class="form-group full-width">
                <label for="notas"><i class="fas fa-sticky-note"></i> Notas (opcional)</label>
                <textarea id="notas" name="notas" rows="3"
                    placeholder="Añade cualquier observación sobre tu progreso..." x-model="formData.notas"></textarea>
            </div>

            <!-- Botones -->
            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i>
                    Guardar Registro
                </button>
                <button type="button" class="btn-secondary" @click="
                    formData.peso = '{{ Auth::user()->peso ?? '' }}';
                    formData.altura = '{{ Auth::user()->altura ?? '' }}';
                    formData.notas = '';
                    calculateIMC();
                ">
                    <i class="fas fa-undo"></i>
                    Restablecer
                </button>
            </div>
        </div>
    </form>
</div>

