<!DOCTYPE html>
<html>
<head>
    <title>Reporte de comidas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        ul {
            list-style-type: none; /* Elimina las viñetas */
            padding-left: 0;       /* Elimina la sangría */
            margin: 0;             /* Elimina cualquier margen */
        }
    </style>
</head>
<body>
    <h1>Reporte de comidas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descipcion</th>
                <th>Calorias</th>
                <th>Macros</th>
            
                
            </tr>
        </thead>
        <tbody>
            @foreach($comidas as $comida)
                <tr>
                    <td>{{ $comida->id_comida }}</td>
                    <td>{{ $comida->descripcion }}</td>
                    <td>{{ $comida->calorias }}</td>
                    <!-- Decodificando el JSON de 'macros' -->
                    @php
                    $macros = json_decode($comida->macros, true);
                    @endphp

                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                        @if($macros)
                        <ul class="list-none">
                            <li><strong>Proteínas:</strong> {{ $macros['proteinas'] }} g</li>
                            <li><strong>Carbohidratos:</strong> {{ $macros['carbohidratos'] }} g</li>
                            <li><strong>Grasas:</strong> {{ $macros['grasas'] }} g</li>
                        </ul>
                        @else
                        <span>No disponible</span>
                        @endif
                    </td>
                    
                  

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
