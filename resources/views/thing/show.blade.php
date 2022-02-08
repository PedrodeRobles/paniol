<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <h1>Materiales del pañol</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo de material</th>
                <th>Estado</th>
                <th>Descripción</th>
            </tr>
            <tbody>
                    <tr>
                        <td>{{ $thing->name }}</td>
                        <td>
                            @if ($thing->type_id == 1)
                                <p>Audio</p>
                            @elseif ($thing->type_id == 2)
                                <p>Herramienta</p>
                            @elseif ($thing->type_id == 3)
                                <p>Informática</p>
                            @endif
                        </td>
                        <td>
                            @if ($thing->state_id == 1)
                                <p>En Pañol</p>
                            @elseif ($thing->state_id == 2)
                                <p>En Uso</p>
                            @endif
                        </td>
                        <td>{{ $thing->description }}</td>
                    </tr>
            </tbody>
        </thead>
    </table>
</body>
</html>