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

    <div class="h-14 flex items-start justify-center mt-6">
        <h1 class="text-4xl">Ordenes</h1>
    </div>

    <div class="mt-4 mb-4 sm:mb-7 ml-2 sm:flex sm:space-x-6">
        <a href="{{ route('thing.index') }}" class="bg-blue-600 text-white rounded py-1 px-2">Objetos</a>
    
        <a class="bg-gray-600 rounded px-2 py-1" href="{{ route('history.index') }}">Historial de ordenes</a>
    </div>

    {{-- FORMULARIO PARA GENERAR ORDENES --}}
    <div class="border-2 border-gray-300 bg-gray-900 rounded-lg mx-2  md:w-11/12 lg:w-9/12 xl:w-7/12 2xl:w-6/12">
        <h2 class="text-xl mx-2">Generar Orden</h2>

        <div class="m-2">
            <form action="{{ route('order.store') }}" method="POST">
                <div class="sm:flex sm:items-center">
                    <div class="flex flex-col sm:inline space-y-2 ">
                        <label class="font-semibold">Persona *</label>
                        <select class="bg-gray-700 py-1" name="person_id">
                            @foreach ($people as $person)
                                <option value="{{ $person->id }}">{{ $person->name }} {{ $person->last_name }}</option>
                            @endforeach
                        </select>
            
                        <label class="sm:ml-6 font-semibold">Nombre de orden *</label>
                        <input class="bg-gray-700 py-1" type="text" name="identifier">

                        <input type="submit" value="Agregar" class="sm:ml-10 bg-green-500 hover:bg-green-400 rounded-md px-4 py-1 text-white cursor-pointer">                       
                    </div>
    
                    
                </div>

                @csrf
            </form>
        </div>
    </div>

    <div class="lg:w-12/12 xl:w-11/12 overflow-auto rounded-lg shadow mt-6 border-2 border-gray-300 mx-2 mb-10">
        <h2 class="text-2xl my-2 ml-2">Lista de ordenes activas</h2>
        {{-- TABLA DE ORDENES --}}
        <table class="w-full">
            <thead class="border-y-2 border-gray-200">
                <tr>
                    <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">ID</th>
                    <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Persona</th>
                    <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Identificador</th>
                    <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Pañolero</th>
                    <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Fecha</th>
                    <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Return</th>
                </tr>
                <tbody class="divide-y divide-gray-400">
                    @foreach ($orders as $order)
                    @if ($order->id == 1 || $order->return == 2)
                        <p class="hidden">.</p>
                    @else
                        <tr class="bg-gray-700 text-center">
                            <td class="p-2">{{ $order->id }}</td>
                            <td class="p-2">
                                {{ $order->person->name }}
                                {{ $order->person->last_name }}
                                ({{ $order->person->place }})
                            </td>
                            <td class="p-2">{{ $order->identifier }}</td>
                            <td class="p-2">{{ $order->user->name }}</td>
                            <td class="p-2">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="p-2 text-center">{{ $order->return }}</td>

                            {{-- Botones --}}
                            <div>
                                <td class="p-2">
                                    <a class="py-1 px-2 bg-gray-600 rounded-md" href="{{ route('order.show', $order) }}">Ver</a>
                                </td>
                                <td class="p-2">
                                    <a class="py-1 px-2 bg-blue-600 rounded-md" href="{{ route('order.pdf', $order) }}">PDF</a>
                                </td>
                                <td class="p-2">
                                    <a class="py-1 px-2 bg-green-600" href="{{ route('order.edit', $order) }}">Agregar objetos</a>
                                </td>
                                <td class="p-2">
                                    @if ($order->return == 1)
                                        <form action="{{ route('order.update', $order) }}" method="POST" enctype="multipart/form-data">
                                            <input 
                                                type="submit" 
                                                value="Devolver" 
                                                class="bg-gray-600 rounded px-2 cursor-pointer"
                                                onclick="return confirm('¿Deseas devolver todos los objetos de esta orden?')">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @else
                                        <p class="text-green-600">Entregado</p>
                                    @endif
                                </td>
                                <td class="p-2">
                                    <form action="{{ route('order.destroy', $order) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input 
                                            class="bg-red-500 rounded px-2 text-white"
                                            type="submit"
                                            value="Delete"
                                            onclick="return confirm('¿Estas seguro que quieres borrar esta orden o quieres devolver los objetos?')">
                                    </form>
                                </td>
                            </div>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
            </thead>
        </table>
    </div>
        
</body>
</html>