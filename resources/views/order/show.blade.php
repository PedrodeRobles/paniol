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
        <h1 class="text-4xl">Visualización de Orden</h1>
    </div>

    {{-- Información de la Orden --}}
    <div class="border-2 border-gray-300 rounded-lg bg-gray-900 mx-2 lg:mx-64 xl:mx-96 mt-7 mb-10">
        <h2 class="text-2xl font-semibold flex justify-center border-b-2 border-gray-200 py-2">
            Datos de la orden
        </h2>

        <div class="m-2">
            <div class="flex">
                <label class="font-semibold">ID de la orden:</label>
                <p class="ml-2">{{ $order->id }}</p>
            </div>
            <div class="flex">
                <label class="font-semibold">Persona:</label>
                <p class="ml-2">
                    {{ $order->person->name }} 
                    {{ $order->person->last_name }}
                    ({{ $order->person->place }})
                </p>
            </div>
            <div class="flex">
                <label class="font-semibold">Identificador:</label>
                <p class="ml-2">{{ $order->identifier }}</p>
            </div>
            <div class="flex">
                <label class="font-semibold">Pañolero:</label>
                <p class="ml-2">{{ $order->user->name }}</p>
            </div>
            <div class="flex">
                <label class="font-semibold">Estado de orden:</label>
                @if ($order->return == 1)
                    <p class="ml-2">Activa</p>
                @else
                    <p class="ml-2">Inactiva</p>
                @endif
            </div>
            <div class="flex">
                <label class="font-semibold">Fecha:</label>
                <p class="ml-2">{{ $order->created_at->format('d/m/Y') }}</p>
            </div>
    
            <div class="mt-2 border-t border-gray-200">
                <h2 class="text-xl">Objetos:</h2>

                @foreach ($things as $thing)
                    <div class="flex">
                        <p>- {{ $thing->name }}</p>
                        <p class="ml-2">({{ $thing->identifier }})</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</body>
</html>