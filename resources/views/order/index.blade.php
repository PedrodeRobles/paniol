<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <title>Pañol</title>
</head>
<body>
    <h1 class="text-4xl text-center">Generar orden</h1>

    <button class="my-4">
        <a href="{{ route('thing.index') }}" class="bg-blue-600 text-white rounded h-6 py-1 px-2">Elementos</a>
    </button>

    {{-- FORMULARIO PARA GENERAR ORDENES --}}
    <form action="{{ route('order.store') }}" method="POST">
        <label>Persona</label>
        <select name="person_id">
            @foreach ($people as $person)
                <option value="{{ $person->id }}">{{ $person->name }}</option>
            @endforeach
        </select>


        <label>Nombre de orden</label>
        <input type="text" name="identifier">

        <input type="submit" value="Agregar">
        @csrf
    </form>


    {{-- TABLA DE ORDENES --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Persona</th>
                <th>Identificador</th>
                <th>Pañolero</th>
                <th>Fecha</th>
                <th>Hora de creación</th>
                <th>Return</th>
            </tr>
            <tbody>
                @foreach ($orders as $order)
                @if ($order->id == 1)
                    .
                @else
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->person->name }}</td>
                        <td>{{ $order->identifier }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td class="text-center">{{ $order->created_at->format(' H:i ') }}</td>
                        <td>{{ $order->return }}</td>
                        <td>
                            <button class="bg-gray-300 rounded w-14"><a href="{{ route('order.show', $order) }}">Ver</a></button>
                        </td>
                        <td>
                            <button class="bg-gray-300 rounded w-14"><a href="{{ route('order.edit', $order) }}">Editar</a></button>
                        </td>
                        <td>
                            @if ($order->return == 0)
                                <form action="{{ route('order.update', $order) }}" method="POST" enctype="multipart/form-data">
                                    <input type="submit" value="Devolver" class="bg-gray-300 rounded w-20 pointer">
                                    @csrf
                                    @method('PUT')
                                </form>
                            @else
                                <p class="text-green-600">Entregado</p>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('order.destroy', $order) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input 
                                    class="bg-red-500 rounded w-14 text-white"
                                    type="submit"
                                    value="Delete"
                                    onclick="return confirm('¿Estas seguro que quieres eliminar este tipo de material?')">
                            </form>
                        </td>
                    </tr>
                @endif
                @endforeach
            </tbody>
        </thead>
    </table>
    {{ $orders->links() }}
</body>
</html>