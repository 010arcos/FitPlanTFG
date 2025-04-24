<!DOCTYPE html>
<html>
<head>
    <title>Reporte de usuarios</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Reporte de usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>Peso</th>
                <th>Alta</th>
                <th>Email</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->genero }}</td>
                    <td>{{ $usuario->peso }}</td>
                    <td>{{ $usuario->activo == 1 ? 'Activo' : 'Inactivo' }}</td>
                    <td>{{ $usuario->email}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
