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
                <th>Raza</th>
                <th>Videojuego</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->genero }}</td>
                    <td>{{ $usuario->peso }}</td>
                    <td>
                        <!-- Mostrar los videojuegos asociados -->
                        @foreach($usuario->videojuegos as $videojuego)
                            {{ $videojuego->nombre }} @if(!$loop->last), @endif <!-- Separa los videojuegos con coma -->
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
