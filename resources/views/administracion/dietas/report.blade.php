<!DOCTYPE html>
<html>
<head>
    <title>Reporte de dietas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Reporte de dietas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descipcion</th>
                <th>Fecha Inico</th>
                <th>Fecha Fin</th>
            
                
            </tr>
        </thead>
        <tbody>
            @foreach($dietas as $dieta)
                <tr>
                    <td>{{ $dieta->id_dieta }}</td>
                    <td>{{ $dieta->nombre }}</td>
                    <td>{{ $dieta->descripcion }}</td>
                    <td>{{ $dieta->fecha_inicio }}</td>
                    <td>{{ $dieta->fecha_fin }}</td>
                  

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
