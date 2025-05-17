<!DOCTYPE html>
<html>

<head>
    <title>Reporte de ejercicios</title>
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

        ul {
            list-style-type: none;
            /* Elimina las viñetas */
            padding-left: 0;
            /* Elimina la sangría */
            margin: 0;
            /* Elimina cualquier margen */
        }
    </style>
</head>

<body>
    <h1>Reporte de ejercicios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descipcion</th>
               


            </tr>
        </thead>
        <tbody>
            @foreach($ejercicios as $ejercicio)
            <tr>
                <td>{{ $ejercicio->id_ejercicio }}</td>
                <td>{{ $ejercicio->nombre }}</td>
                <td>{{ $ejercicio->descripcion }}</td>
             
                <!-- Decodificando el JSON de 'macros' -->
                @php
                $macros = json_decode($ejercicio->macros, true);
                @endphp





            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>