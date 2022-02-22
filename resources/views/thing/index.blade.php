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
    <div class="bg-blue-500 h-14 border-b-2 border-t-2 border-black">
        <h1 class="text-center text-4xl">Materiales del pañol</h1>
    </div>

    {{-- Search form --}}
    <div class="pt-10 pb-6">
        <h2 class="text-xl">Buscar Material</h2>
        <form action="">
            <input type="search" name="search" placeholder="Buscar" class="rounded-md h-7">
            <button type="submit" class="bg-gray-300 rounded w-14">Buscar</button>
        </form>
    </div>

    <button><a href="{{ route('thing.create') }}" class="bg-blue-400 rounded h-6">Agregar material</a></button>

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