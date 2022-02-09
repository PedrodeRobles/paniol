<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <h1>Generar orden</h1>

    {{-- FORMULARIO PARA GENERAR ORDENES --}}
    <h2>Buscar Material</h2>
    <form action="{{ route('order.store') }}" method="POST">
        <label for="">Nombre del material</label>
        {{-- <input type="text" name="name_of_thing"> --}}
        <select name="name_of_thing">
            @foreach ($things as $thing)
                @if ($thing->state_id != 2)
                    <option value="{{ $thing->id }}">{{ $thing->name }}</option>
                @endif
            @endforeach
        </select>

        <input type="text" name="identifier">

        <input type="submit" value="Agregar">
        @csrf
    </form>


    {{-- TABLA DE ORDENES --}}
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Identificador</th>
            </tr>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->name_of_thing }}</td>
                        <td>
                            {{ $order->identifier}}
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