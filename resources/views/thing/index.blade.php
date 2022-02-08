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

    {{-- Search form --}}
    <h2>Buscar Material</h2>
    <form action="">
        <input type="search" name="search" placeholder="Buscar">
        <button type="submit">Buscar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo de material</th>
                <th>Estado</th>
            </tr>
            <tbody>
                @foreach ($things as $thing)
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