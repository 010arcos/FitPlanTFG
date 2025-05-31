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




@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

    @if(isset($datosGraficos) && count($datosGraficos['pesos']) > 0)
        const datosGraficos = @json($datosGraficos);
        
        // Gráfico de peso
        const ctxPeso = document.getElementById('pesoChart');
        if (ctxPeso && typeof Chart !== 'undefined') {
            new Chart(ctxPeso, {
                type: 'line',
                data: {
                    labels: datosGraficos.fechas,
                    datasets: [{
                        label: 'Peso (kg)',
                        data: datosGraficos.pesos,
                        borderColor: '#1e40af',
                        backgroundColor: 'rgba(30, 64, 175, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    @endif
});
</script>
@endpush