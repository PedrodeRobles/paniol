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

    <button class="mt-4">
        <a href="{{ route('order.index') }}" class="bg-blue-600 text-white rounded h-6 py-1 px-2">Ver ordenes</a>
    </button>

    <button class="mt-4">
        <a href="{{ route('thing.bin') }}" class="bg-gray-400 text-white rounded h-6 py-1 px-2">Papelera de objetos</a>
    </button>


    {{-- Search form --}}
    <div class="pt-10 pb-6">
        <h2 class="text-xl">Buscar Material</h2>
        <form action="">
            <input type="search" name="search" placeholder="Buscar" class="rounded-md h-7">
            <button type="submit" class="bg-gray-300 rounded w-14">Buscar</button>
        </form>
    </div>

    <button><a href="{{ route('thing.create') }}" class="bg-green-500 text-white py-1 px-4 rounded h-6">Agregar material</a></button>

    <table class="mt-4">
        <thead>
            <tr>
                <th>Identificador</th>
                <th>Objeto</th>
                <th>Tipo de material</th>
                <th>Estado</th>
                <th>Numero de orden</th>
            </tr>
            <tbody>
                @foreach ($things as $thing)
                @if ($thing->visibility == 1)
                    @if ($thing->state_id == 1)
                        <tr class="bg-blue-400">
                            <td>{{ $thing->identifier }}</td>
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
                                        class="bg-red-500 rounded w-14 text-white cursor-pointer"
                                        type="submit"
                                        value="Delete"
                                        onclick="return confirm('¿Estas seguro que quieres eliminar este tipo de material?')">
                                </form>
                            </td>
                        </tr>
                    @else
                        <tr class="bg-red-400">
                            <td>{{ $thing->identifier }}</td>
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
                                        class="bg-red-500 rounded w-14 text-white cursor-pointer"
                                        type="submit"
                                        value="Delete"
                                        onclick="return confirm('¿Estas seguro que quieres eliminar este tipo de material?')">
                                </form>
                            </td>
                        </tr>
                    @endif
                @else
                    .
                @endif
                    
                @endforeach
            </tbody>
        </thead>
    </table>
</body>
</html>