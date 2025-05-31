@if(isset($datosGraficos) && count($datosGraficos['pesos']) > 0)
<div class="chart-container">
    <canvas id="pesoChart"></canvas>
</div>

<!-- Estadísticas -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-weight"></i></div>
        <div class="stat-info">
            <span class="stat-label">Peso Actual</span>
            <span class="stat-value">{{ $datosGraficos['pesos']->last() }} kg</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
        <div class="stat-info">
            <span class="stat-label">Cambio Total</span>
            <span class="stat-value">
                {{ round($datosGraficos['pesos']->last() - $datosGraficos['pesos']->first(), 1) }} kg
            </span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-calendar"></i></div>
        <div class="stat-info">
            <span class="stat-label">Registros</span>
            <span class="stat-value">{{ count($datosGraficos['pesos']) }}</span>
        </div>
    </div>
</div>
@else
<div class="progress-chart">
    <div class="chart-placeholder">
        <div class="empty-icon"><i class="fas fa-chart-area"></i></div>
        <p>No hay datos de peso registrados</p>
        <p class="empty-subtitle">Agrega tu primer registro en la sección Medidas</p>
    </div>
</div>
@endif