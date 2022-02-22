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
    <h1 class="text-4xl text-center">Editar Orden</h1>

    {{-- ORDEN --}}
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
                            @if ($order->return == 0)
                                <form action="{{ route('order.update', $order) }}" method="POST" enctype="multipart/form-data">
                                    <input type="submit" value="Devolver" class="bg-gray-300 rounded w-20 cursor-pointer ">
                                    @csrf
                                    @method('PUT')
                                </form>
                            @else
                                <p class="text-green-600">Entregado</p>
                            @endif
                        {{-- </td>
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
                        </td> --}}
                    </tr>
                @endif
            </tbody>
        </thead>
    </table>

    <h2 class="text-xl">Agregar elementos a la orden</h2>
    
        {{-- Search form --}}
        <div class="pt-10 pb-6">
            <h2 class="text-xl">Buscar Material (Todavía no programe este buscador en esta vista)</h2>
            <form action="">
                <input type="search" name="search" placeholder="Buscar" class="rounded-md h-7">
                <button type="submit" class="bg-gray-300 rounded w-14">Buscar</button>
            </form>
        </div>

        {{-- TABLA DE THINGS --}}
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
                                        <option value="{{ $order->id }}">{{ $order->id }}</option>
                                        <option value="{{ $returnOrder = 1 }}">{{ $returnOrder  }}</option>
                                    </select>
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" value="Actualizar" class="bg-gray-300 rounded w-20">
                                </form>
                            </td>
                            {{-- <td>
                                <form action="{{ route('thing.return', $thing) }}" method="POST" enctype="multipart/form-data">
                                    <input type="submit" value="Devolver" class="bg-gray-300 rounded w-20 pointer">
                                    @csrf
                                    @method('PUT')
                                </form>
                            </td> --}}
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
    </table>
</body>
</html>