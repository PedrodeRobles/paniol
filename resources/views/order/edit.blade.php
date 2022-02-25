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
    <h1 class="text-4xl text-center">Agregar objetos a la orden</h1>

    <button class="my-4 ml-4">
        <a href="{{ route('order.index') }}" class="bg-blue-600 text-white rounded h-6 py-1 px-2">Ver ordenes</a>
    </button>

    {{-- ORDEN --}}
    <div class="flex items-center">
        <table class="bg-gray-200 my-4 mx-4">
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
                            </td>
                        </tr>
                    @endif
                </tbody>
            </thead>
        </table>
    
        <div>
            <button class="bg-blue-500 hover:bg-blue-400 rounded px-4 py-2 text-white"><a href="{{ route('order.pdf', $order) }}">PDF</a></button>
        </div>
    </div>
    

    <div class="mt-10 ml-2 w-4/5 border-2 border-black rounded-xl">
        <h2 class="text-2xl">Lista de objetos</h2>
    
        {{-- Search form --}}
        <div class="pt-4 pb-6">
            <h2 class="text-xl">Buscar objeto</h2>
            <form action="">
                <input type="search" name="search" placeholder="Buscar" class="rounded-md h-7">
                <button type="submit" class="bg-gray-300 rounded w-14">Buscar</button>
            </form>
        </div>

            {{-- TABLA DE THINGS --}}
        <table>
            <thead>
                <tr>
                    <th>Identificador</th>
                    <th>Objeto</th>
                    <th>Tipo de material</th>
                    <th>Estado</th>
                    <th>Identificador de orden</th>
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
                                    {{ $thing->order->identifier }}
                                </td>
                                <td class="text-center">
                                    {{ $thing->order_id }}
                                </td>
                                <td>
                                    <form action="{{ route('thing.update', $thing) }}" method="POST" enctype="multipart/form-data">
                                        <select name="order_id" hidden>
                                            <option value="{{ $order->id }}">{{ $order->id }}</option>
                                            <option value="{{ $returnOrder = 1 }}">{{ $returnOrder  }}</option>
                                        </select>
                                        @csrf
                                        @method('PUT')
                                        <input type="submit" value="Agregar" class="bg-gray-300 rounded w-20">
                                    </form>
                                </td>
                                <td>
                                    <button class="bg-gray-300 rounded w-14"><a href="{{ route('thing.show', $thing) }}">Ver</a></button>
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
                                    {{ $thing->order->identifier }}
                                </td>
                                <td class="text-center">
                                    {{ $thing->order_id }}
                                </td>
                                <td>
                                    <form action="{{ route('thing.update', $thing) }}" method="POST" enctype="multipart/form-data">
                                        <select name="order_id" hidden>
                                            <option value="{{ $returnThing = 1 }}">{{ $returnThing  }}</option>
                                        </select>
                                        @csrf
                                        @method('PUT')
                                        <input type="submit" value="Devolver" class="bg-gray-300 rounded w-20">
                                    </form>
                                </td>
                                <td>
                                    <button class="bg-gray-300 rounded w-14"><a href="{{ route('thing.show', $thing) }}">Ver</a></button>
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
    </div>
</body>
</html>