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

    <div class="h-14 flex items-start mt-6 ml-4">
        <h1 class="text-center text-4xl">Historial de ordenes</h1>
    </div>

    <div class="lg:w-12/12 xl:w-11/12 overflow-auto rounded-lg shadow mt-6 border-2 border-gray-300 mx-2 mb-10">
        <h2 class="text-2xl my-2 ml-2">Ordenes inactivas</h2>
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
                    {{-- <th class="p-3">Opciones</th> --}}
                </tr>
                <tbody class="divide-y divide-gray-400">
                    @foreach ($orders as $order)
                    @if ($order->id == 1 || $order->return == 1)
                        <p class="hidden">.</p>
                    @else
                        <tr class="bg-gray-700 text-center">
                            <td class="p-2">{{ $order->id }}</td>
                            <td class="p-2">{{ $order->person->name }}</td>
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