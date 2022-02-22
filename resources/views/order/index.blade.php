<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Pañol</title>
</head>
<body>
    <h1 class="text-4xl text-center">Generar orden</h1>

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
                                <p class="text-green-600">Devolvio</p>
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

    {{-- THINGS --}}
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
                @if ($thing->visibility == 1)
                    <tr>
                        <td>{{ $thing->name }}</td>
                        <td>
                            {{ $thing->type->type}}
                        </td>
                        <td>
                            {{ $thing->state->state }}
                        </td>
                        <td class="text-center">
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
                                <input type="submit" value="Actualizar" class="bg-gray-300 rounded w-20">
                            </form>
                        </td>
                        <td>
                            <button class="bg-gray-300 rounded w-14"><a href="{{ route('thing.show', $thing) }}">Ver</a></button>
                        </td>
                        <td>
                            <button class="bg-gray-300 rounded w-14"><a href="{{ route('thing.edit', $thing) }}">Editar</a></button>
                        </td>
                        <td>
                            <form action="{{ route('thing.destroy', $thing) }}" method="POST">
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
                @else
                    .
                @endif
                    
                @endforeach
            </tbody>
        </thead>
    </table>
</body>
</html>