<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Pañol</title>
</head>
<header>
    <x-header/>
</header>
<body class="bg-slate-800 text-white">
    <div class="h-14 flex items-start mt-6 ml-4">
        <h1 class="text-center text-4xl">Materiales del pañol</h1>
    </div>

    <div class="flex justify-start space-x-10 ml-4">
        <button class="mt-4">
            <a href="{{ route('order.index') }}" class="bg-blue-600 text-white rounded h-6 py-1 px-2 shadow-md">Generar Orden</a>
        </button>
    
        <button class="mt-4">
            <a href="{{ route('thing.bin') }}" class="bg-gray-400 text-white rounded h-6 py-1 px-2 shadow-md">Papelera de objetos</a>
        </button>
    </div>

    {{-- Search form --}}
    <div class="pt-10 pb-6">
        <h2 class="text-xl">Buscar Material</h2>
        <form action="">
            <input type="search" name="search" placeholder="Buscar" class="rounded-md h-7">
            <button type="submit" class="bg-gray-300 rounded w-14">Buscar</button>
        </form>
    </div>

    <button><a href="{{ route('thing.create') }}" class="bg-green-500 text-white py-1 px-4 rounded h-6">Agregar material</a></button>
    
    {{-- <table class="mt-4">
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
                    @if ($thing->state == 1)
                        <tr class="bg-blue-400">
                            <td>{{ $thing->identifier }}</td>
                            <td>{{ $thing->name }}</td>
                            <td>
                                {{ $thing->type->type}}
                            </td>
                            <td>
                                <p>En Pañol</p>
                            </td>
                            <td class="text-center">
                                <p>-</p>
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
                                <p>En Uso</p>
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
                                @if ($thing->order_id == 1)
                                    <form action="{{ route('thing.destroy', $thing) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input 
                                            class="bg-red-500 rounded w-14 text-white cursor-pointer"
                                            type="submit"
                                            value="Delete"
                                            onclick="return confirm('¿Estas seguro que quieres eliminar este tipo de material?')">
                                    </form>
                                @else
                                    <p></p>
                                @endif
                            </td>
                        </tr>
                    @endif
                @else
                    .
                @endif
                    
                @endforeach
            </tbody>
        </thead>
    </table> --}}
</body>
</html>