@extends('layouts.usuario.appUser')

@section('content')


<div class="diet-wrapper">
    <div class="diet-container">

        <!-- Dashboard de dietas -->
        <div class="diet-dashboard" x-data="{ 
            activeSection: 'desayuno', 
            selectedDiet: '{{ count($dietas) > 0 ? $dietas[0]->id_dieta : '' }}' 
        }">

            <!-- Navegación lateral -->
            <aside class="diet-sidebar">
                <div class="sidebar-header">

                    <h3> <i class="fas fa-utensils"></i> Comidas</h3>
                </div>

                <nav class="diet-navigation">
                    @foreach(['desayuno', 'almuerzo', 'comida', 'merienda', 'cena'] as $comida)
                    <button class="nav-item" :class="{ 'nav-item-active': activeSection === '{{ $comida }}' }"
                        @click="activeSection = '{{ $comida }}'">
                        <span class="nav-icon">
                            @switch($comida)
                            @case('desayuno') <i class="fas fa-sun"></i> @break
                            @case('almuerzo') <i class="fas fa-coffee"></i> @break
                            @case('comida') <i class="fas fa-utensils"></i> @break
                            @case('merienda') <i class="fas fa-apple-alt"></i> @break
                            @case('cena') <i class="fas fa-moon"></i> @break
                            @endswitch
                        </span>
                        <span class="nav-label">{{ ucfirst($comida) }}</span>
                    </button>
                    @endforeach
                </nav>
            </aside>

            <!-- Contenido principal -->
            <main class="diet-content">
                @if(count($dietas) > 0)
                <!-- Selector de dieta compacto -->
                <div class="diet-selector-section">
                    <select x-model="selectedDiet" class="diet-selector">
                        @foreach($dietas as $dieta)
                        <option value="{{ $dieta->id_dieta }}">{{ $dieta->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Secciones de comidas -->
                @foreach(['desayuno', 'almuerzo', 'comida', 'merienda', 'cena'] as $tipoComida)
                <section x-show="activeSection === '{{ $tipoComida }}'" x-cloak class="meal-section">
                    <div class="meal-section-header">
                        <h2 class="meal-title">
                            @switch($tipoComida)
                            @case('desayuno') <i class="fas fa-sun"></i> @break
                            @case('almuerzo') <i class="fas fa-coffee"></i> @break
                            @case('comida') <i class="fas fa-utensils"></i> @break
                            @case('merienda') <i class="fas fa-apple-alt"></i> @break
                            @case('cena') <i class="fas fa-moon"></i> @break
                            @endswitch
                            {{ ucfirst($tipoComida) }}
                        </h2>
                    </div>

                    <!-- Contenido por dieta -->
                    @foreach($dietasOrganizadas as $dietaId => $dietaData)
                    <div x-show="selectedDiet == '{{ $dietaId }}'" class="diet-content-wrapper">
                        @if(isset($dietaData['comidas'][$tipoComida]) && count($dietaData['comidas'][$tipoComida]) > 0)
                        <div class="meals-grid">
                            @foreach($dietaData['comidas'][$tipoComida] as $comida)
                            <article class="meal-card">
                                <!-- Header de la comida -->
                                <header class="meal-card-header">
                                    <h3 class="meal-name">{{ $comida->nombre }}</h3>
                                    <span class="meal-calories">{{ $comida->calorias }} kcal</span>
                                </header>

                                <!-- Ingredientes -->
                                @php
                                $alimentos = json_decode($comida->alimentos, true);
                                @endphp

                                @if($alimentos && isset($alimentos['ingredientes']))
                                <div class="meal-ingredients">
                                    <h4 class="ingredients-title">
                                        <i class="fas fa-list"></i>
                                        Ingredientes:
                                    </h4>
                                    <ul class="ingredients-list">
                                        @foreach($alimentos['ingredientes'] as $ingrediente)
                                        <li class="ingredient-item">
                                            <span class="ingredient-name">{{ $ingrediente['nombre'] }}</span>
                                            <span class="ingredient-quantity">{{ $ingrediente['cantidad'] }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <!-- Macronutrientes -->
                                @php
                                $macros = json_decode($comida->macros, true);
                                @endphp

                                @if($macros)
                                <footer class="meal-macros">
                                    <div class="macro-item macro-protein">
                                        <span class="macro-value">{{ $macros['proteinas'] }}g</span>
                                        <span class="macro-label">Proteínas</span>
                                    </div>
                                    <div class="macro-item macro-carbs">
                                        <span class="macro-value">{{ $macros['carbohidratos'] }}g</span>
                                        <span class="macro-label">Carbohidratos</span>
                                    </div>
                                    <div class="macro-item macro-fats">
                                        <span class="macro-value">{{ $macros['grasas'] }}g</span>
                                        <span class="macro-label">Grasas</span>
                                    </div>
                                </footer>
                                @endif
                            </article>
                            @endforeach
                        </div>
                        @else
                        <!-- Estado vacío -->
                        <div class="empty-meal-state">
                            <i class="fas fa-utensils empty-icon"></i>
                            <h3 class="empty-title">No hay {{ $tipoComida }} programado</h3>
                            <p class="empty-description">
                                No tienes comidas asignadas para esta parte del día.
                            </p>
                            <p class="empty-suggestion">Consulta con tu nutricionista</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </section>
                @endforeach

                @else
                <!-- Estado sin dietas -->
                <div class="no-diets-state">
                    <i class="fas fa-exclamation-circle no-diets-icon"></i>
                    <h2 class="no-diets-title">No tienes dietas asignadas</h2>
                    <p class="no-diets-description">
                        Aún no tienes ningún plan alimentario asignado.
                    </p>
                    <p class="no-diets-suggestion">
                        Contacta con tu nutricionista.
                    </p>
                </div>
                @endif
            </main>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
    console.log('Diet dashboard initialized');
});
</script>
@endsection