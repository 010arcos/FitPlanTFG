import './bootstrap';
import 'bootstrap';

import Alpine from 'alpinejs';

// Importar Chart.js y hacerlo global
import Chart from 'chart.js/auto';
window.Chart = Chart;

window.Alpine = Alpine;

Alpine.start();
