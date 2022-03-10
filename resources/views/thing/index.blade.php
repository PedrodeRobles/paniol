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
    <div class="ml-2 mt-4">
        <a class="px-2 py-1 bg-blue-500 rounded-lg" href="{{ url('/') }}">Volver</a>
    </div>

    <div class="h-14 flex items-start mt-6 ml-4">
        <h1 class="text-center text-4xl">Materiales del pañol</h1>
    </div>

    <div class="grid grid-cols-2 gap-6 mt-4 sm:flex sm:ml-4">
        <button><a href="{{ route('thing.create') }}" class="bg-green-600 text-white py-1 px-2 rounded">Agregar material</a></button>

        <button>
            <a href="{{ route('thing.bin') }}" class="border-2 border-gray-500 text-white rounded py-1 px-1 shadow-md">Papelera de Objetos </a>
        </button>

        <button>
            <a href="{{ route('order.index') }}" class="bg-blue-600 text-white rounded py-1 px-2 shadow-md">Generar Orden</a>
        </button>
    </div>
    

    <div class="my-10 border-2 border-gray-200 rounded-lg mx-4">
        {{-- Search form --}}
        <div class="mt-4 sm:ml-4">
            <h2 class="text-xl mb-2">Buscar Material</h2>
            <form>
                <input class="bg-gray-700 rounded-md py-1" type="search" name="search" placeholder="Buscar" class="rounded-md py-1 text-black">
                <button type="submit" class="bg-gray-600 rounded py-1 px-1">Buscar</button>
            </form>
        </div>

        <div class="overflow-auto rounded-lg shadow mt-6">
            <table class="w-full">
                <thead class="border-y-2 border-gray-200">
                    <tr>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Identificador</th>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Objeto</th>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Tipo de material</th>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Estado</th>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Numero de orden</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($things as $thing)
                        @if ($thing->visibility == 1)
                        @if ($thing->state == 1)
                            <tr class="bg-blue-500">
                                <td class="p-2 border-r border-gray-200">{{ $thing->identifier }}</td>
                                <td class="p-2 border-r border-gray-200">{{ $thing->name }}</td>
                                <td class="p-2 border-r border-gray-200">
                                    {{ $thing->type->type}}
                                </td>
                                <td class="p-2 border-r border-gray-200">
                                    <p>En Pañol</p>
                                </td>
                                <td class="p-2 text-center border-r border-gray-200">
                                    <p>-</p>
                                </td>
                                <td class="p-2">
                                    <button class="bg-gray-600 rounded w-14">
                                        <a href="{{ route('thing.show', $thing) }}">Ver</a>
                                    </button>
                                </td>
                                <td class="p-2">
                                    <button class="bg-gray-600 rounded w-14">
                                        <a href="{{ route('thing.edit', $thing) }}">Editar</a>
                                    </button>
                                </td>
                                <td class="p-2">
                                    <form action="{{ route('thing.destroy', $thing) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input 
                                            class="bg-red-500 rounded w-14 text-white cursor-pointer"
                                            type="submit"
                                            value="Delete"
                                            onclick="return confirm('¿Estas seguro que quieres eliminar este objeto?')">
                                    </form>
                                </td>
                            </tr>
                        @else
                            <tr class="bg-red-500">
                                <td class="p-2 border-r border-gray-200">{{ $thing->identifier }}</td>
                                <td class="p-2 border-r border-gray-200">{{ $thing->name }}</td>
                                <td class="p-2 border-r border-gray-200">
                                    {{ $thing->type->type}}
                                </td>
                                <td class="p-2 border-r border-gray-200">
                                    <p>En Uso</p>
                                </td>
                                <td class="p-2 text-center border-r border-gray-200">
                                    {{ $thing->order->id }}
                                </td>
                                <td class="p-2">
                                    <button class="bg-gray-600 rounded w-14">
                                        <a href="{{ route('thing.show', $thing) }}">Ver</a>
                                    </button>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                                <td>
                                    <p></p>
                                </td>
                            </tr>
                        @endif
                        @else
                            .
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
    
</body>
</html>