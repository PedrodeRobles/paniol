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
        <a class="px-2 py-1 bg-blue-500 rounded-lg" href="{{ route('order.index') }}">Volver</a>
    </div>

    <div class="h-14 flex items-start justify-center mt-6">
        <h1 class="text-4xl">Agregar objetos a la orden</h1>
    </div>

    <div class="border-2 border-gray-300 rounded-lg bg-gray-900 mx-2 xl:mx-36 mt-7 mb-10">
        <h2 class="text-2xl font-semibold flex justify-center border-b-2 border-gray-200 py-2">
            Orden
        </h2>

        {{-- ORDEN --}}
        <div class="m-2 md:flex md:space-x-2 md:justify-around border-b border-gray-200 pb-4">
            <div class="flex md:flex-col">
                <label class="font-semibold">ID:</label>
                <p class="ml-2">{{ $order->id }}</p>
            </div>
            <div class="flex md:flex-col">
                <label class="font-semibold">Persona:</label>
                <p class="ml-2">{{ $order->person->name }}</p>
            </div>
            <div class="flex md:flex-col">
                <label class="font-semibold">Identificador:</label>
                <p class="ml-2">{{ $order->identifier }}</p>
            </div>
            <div class="flex md:flex-col">
                <label class="font-semibold">Pañolero:</label>
                <p class="ml-2">{{ $order->user->name }}</p>
            </div>
            <div class="flex md:flex-col">
                <label class="font-semibold">Estado de orden:</label>
                @if ($order->return == 1)
                    <p class="ml-2">Activa</p>
                @else
                    <p class="ml-2">Inactiva</p>
                @endif
            </div>
            <div class="flex md:flex-col">
                <label class="font-semibold">Fecha:</label>
                <p class="ml-2">{{ $order->created_at->format('d M Y') }}</p>
            </div>
            <div class="flex justify-around mt-4">
                <button class="bg-blue-500 hover:bg-blue-400 rounded px-2 py-1 text-white"><a href="{{ route('order.pdf', $order) }}">PDF</a></button>
            
                <form action="{{ route('order.update', $order) }}" method="POST" enctype="multipart/form-data">
                    <input type="submit" value="Devolver" class="md:ml-6 bg-gray-600 rounded px-2 py-1 cursor-pointer ">
                    @csrf
                    @method('PUT')
                </form>
            </div>
        </div>
    

    <div class="mt-10 m-2 border-2 border-gray-500 rounded-xl">
        <h2 class="text-2xl ml-2">Lista de objetos</h2>
    
        {{-- Search form --}}
        <div class="mt-4 sm:ml-4 ml-2">
            <h2 class="text-xl mb-2">Buscar Material</h2>
            <form>
                <input class="bg-gray-700 rounded-md py-1 mb-2" type="search" name="search" placeholder="Buscar" class="rounded-md py-1 text-black">
                <button type="submit" class="bg-gray-600 rounded py-1 px-1">Buscar</button>
            </form>
        </div>

        {{-- TABLA DE THINGS --}}
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
                                    <form action="{{ route('order.thingOrder', $thing) }}" method="POST" enctype="multipart/form-data">
                                        <select name="order_id" hidden>
                                            <option value="{{ $order->id }}">{{ $order->id }}</option>
                                            <option value="{{ $returnOrder = 1 }}">{{ $returnOrder  }}</option>
                                        </select>
                                        @csrf
                                        @method('PUT')
                                        <input type="submit" value="Agregar" class="bg-gray-600 rounded w-20">
                                    </form>
                                </td>
                                <td class="p-2">
                                    <button class="bg-gray-600 rounded w-14">
                                        <a href="{{ route('thing.show', $thing) }}">Ver</a>
                                    </button>
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
                                    @if ($thing->order_id == $order->id)
                                        <form action="{{ route('order.thingOrder', $thing) }}" method="POST" enctype="multipart/form-data">
                                            <select name="order_id" hidden>
                                                <option value="{{ $returnThing = 1 }}">{{ $returnThing  }}</option>
                                            </select>
                                            @csrf
                                            @method('PUT')
                                            <input type="submit" value="Devolver" class="bg-gray-600 rounded w-20">
                                        </form>
                                    @else
                                        En otra orden
                                    @endif
                                </td>
                                <td class="p-2">
                                    <button class="bg-gray-600 rounded w-14">
                                        <a href="{{ route('thing.show', $thing) }}">Ver</a>
                                    </button>
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