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
    <h1 class="text-4xl font-semibold text-center">Historial de ordenes</h1>

    <button class="my-4">
        <a href="{{ route('order.index') }}" class="bg-blue-600 text-white rounded h-6 py-1 px-2">Ordenes activas</a>
    </button>

    <div class="mt-10 border-2 border-black rounded-md">
        <h2 class="text-2xl mt-2">Historial</h2>
        {{-- TABLA DE ORDENES --}}
        <table class="mb-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Persona</th>
                    <th>Identificador</th>
                    <th>Pañolero</th>
                    <th>Fecha</th>
                    <th>Hora de creación</th>
                    <th>Return</th>
                    <th>Estado de Orden</th>
                </tr>
                <tbody>
                    @foreach ($orders as $order)
                    @if ($order->id == 1)
                        .
                    @else
                        @if ($order->return == 0)
                            <tr class="bg-lime-500 font-semibold">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->person->name }}</td>
                                <td>{{ $order->identifier }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td class="text-center">{{ $order->created_at->format(' H:i ') }}</td>
                                <td>{{ $order->return }}</td>
                                <td>
                                    <p class="text-black">Orden activa</p>
                                </td>
                                <td>
                                    <button class="bg-gray-300 rounded px-2"><a href="{{ route('order.show', $order) }}">Ver</a></button>
                                </td>
                                <td>
                                    <button class="bg-gray-300 rounded px-2"><a href="{{ route('order.pdf', $order) }}">PDF</a></button>
                                </td>
                            </tr>
                        @else
                            <tr class="bg-rose-600 font-semibold">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->person->name }}</td>
                                <td>{{ $order->identifier }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td class="text-center">{{ $order->created_at->format(' H:i ') }}</td>
                                <td>{{ $order->return }}</td>
                                <td>
                                        <p class="text-black">Entregada</p>
                                </td>
                                <td>
                                    <button class="bg-gray-300 rounded px-2"><a href="{{ route('order.show', $order) }}">Ver</a></button>
                                </td>
                                <td>
                                    <button class="bg-gray-300 rounded px-2"><a href="{{ route('order.pdf', $order) }}">PDF</a></button>
                                </td>
                            </tr>
                        @endif
                    @endif
                    @endforeach
                </tbody>
            </thead>
        </table>
    </div>
</body>
</html>