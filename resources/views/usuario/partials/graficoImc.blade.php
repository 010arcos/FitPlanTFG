@if(isset($datosGraficos) && count($datosGraficos['imcs']) > 0)
<div class="chart-container">
    <canvas id="imcChart"></canvas>
</div>

<!-- Estadísticas IMC -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-calculator"></i></div>
        <div class="stat-info">
            <span class="stat-label">IMC Actual</span>
            <span class="stat-value">{{ $datosGraficos['imcs']->last() }}</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-bullseye"></i></div>
        <div class="stat-info">
            <span class="stat-label">Categoría</span>
            <span class="stat-value">
                @php
                $imc = $datosGraficos['imcs']->last();
                if($imc < 18.5) echo 'Bajo peso' ; elseif($imc < 25) echo 'Normal' ; elseif($imc < 30) echo 'Sobrepeso'
                    ; else echo 'Obesidad' ; @endphp </span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-trend-up"></i></div>
        <div class="stat-info">
            <span class="stat-label">Cambio IMC</span>
            <span class="stat-value">
                {{ round($datosGraficos['imcs']->last() - $datosGraficos['imcs']->first(), 1) }}
            </span>
        </div>
    </div>
</div>
@else
<div class="progress-chart">
    <div class="chart-placeholder">
        <div class="empty-icon"><i class="fas fa-chart-pie"></i></div>
        <p>No hay datos de IMC registrados</p>
        <p class="empty-subtitle">Agrega tu primer registro en la sección Medidas</p>
    </div>
</div>
@endif


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

    @if(isset($datosGraficos) )
        const datosGraficos = @json($datosGraficos);
        

        // Gráfico de IMC
        const ctxIMC = document.getElementById('imcChart');
        if (ctxIMC && typeof Chart !== 'undefined') {
            new Chart(ctxIMC, {
                type: 'line',
                data: {
                    labels: datosGraficos.fechas,
                    datasets: [{
                        label: 'IMC',
                        data: datosGraficos.imcs,
                        borderColor: '#06b6d4',
                        backgroundColor: 'rgba(6, 182, 212, 0.1)',
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