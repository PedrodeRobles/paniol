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

    <button><a href="{{ route('thing.create') }}">Agregar material</a></button>

    <table>
        <thead>
            <tr>
                <th>Tipo de material</th>
                <th>Nombre</th>
                <th>Estado</th>
            </tr>
            <tbody>
                @foreach ($thing as $thing)
                    <tr>
                        <td>
                            @if ($thing->type_id == 1)
                                <p>Audio</p>
                            @elseif ($thing->type_id == 2)
                                <p>Herramienta</p>
                                @elseif ($thing->type_id == 3)
                                <p>Informática</p>
                            @endif
                        </td>
                        <td>{{ $thing->name }}</td>
                        <td>
                            @if ($thing->state_id == 1)
                                <p>En Pañol</p>
                            @elseif ($thing->state_id == 2)
                                <p>En Uso</p>
                            @endif
                        </td>
                        <td>
                            <button><a href="{{ route('thing.show', $thing) }}">Ver</a></button>
                        </td>
                        <td>
                            <button><a href="{{ route('thing.edit', $thing) }}">Editar</a></button>
                        </td>
                        <td>
                            <form action="{{ route('thing.destroy', $thing) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input 
                                    type="submit"
                                    value="Delete"
                                    onclick="return confirm('¿Estas seguro que quieres eliminar este tipo de material?')">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </thead>
    </table>
</body>
</html>