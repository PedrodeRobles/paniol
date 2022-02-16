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

    <button><a href="{{ route('thing.create') }}">Agregar material</a></button>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo de material</th>
                <th>Estado</th>
                <th>Numero de orden</th>
            </tr>
            <tbody>
                @foreach ($things as $thing)
                    <tr>
                        <td>{{ $thing->name }}</td>
                        <td>
                            {{ $thing->type->type}}
                        </td>
                        <td>
                            {{ $thing->state->state }}
                        </td>
                        <td>
                            {{ $thing->order_id }}
                        </td>
                        <td>
                            <form action="{{ route('thing.update', $thing) }}" method="POST" enctype="multipart/form-data">
                                <select name="order_id">
                                    @foreach ($orders as $order)
                                        @if ($order->id == 1)
                                            <option value="{{ $order->id }}">Pañol</option>
                                        @else
                                            <option value="{{ $order->id }}">{{ $order->id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @csrf
                                @method('PUT')
                                <input type="submit" value="Actualizar">
                            </form>
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