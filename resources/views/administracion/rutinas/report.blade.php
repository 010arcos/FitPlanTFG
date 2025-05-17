<!DOCTYPE html>
<html>

<head>
    <title>Reporte de rutinas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Reporte de rutinas</h1>
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
            @foreach($rutinas as $rutina)
            <tr>
                <td>{{ $rutina->id_rutina }}</td>
                <td>{{ $rutina->nombre }}</td>
                <td>{{ $rutina->descripcion }}</td>
                <td>{{ $rutina->fecha_inicio }}</td>
                <td>{{ $rutina->fecha_fin }}</td>


            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>