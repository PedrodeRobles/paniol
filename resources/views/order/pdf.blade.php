<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <title>Pañol</title>
</head>
<body class="bg-slate-800 text-white">

    <div class="h-14 flex items-start justify-center mt-6">
        <h1 class="text-4xl">Comprobante de Orden</h1>
    </div>

    {{-- Información de la Orden --}}
    <div class="border-2 border-gray-300 rounded-lg bg-gray-900 mx-2 lg:mx-64 xl:mx-96 mt-7 mb-10">
        <h2 class="text-2xl font-semibold flex justify-center border-b-2 border-gray-200 py-2">
            Datos de la orden
        </h2>

        <div class="m-2">
            <div class="flex">
                <label class="font-semibold">ID de la orden: {{ $order->id }}</label>
            </div>
            <div class="flex">
                <label class="font-semibold">Persona: {{ $order->person->name }}</label>
            </div>
            <div class="flex">
                <label class="font-semibold">Identificador: {{ $order->identifier }}</label>
            </div>
            <div class="flex">
                <label class="font-semibold">Pañolero: {{ $order->user->name }}</label>
            </div>
            <div class="flex">
                <label class="font-semibold">Estado de orden: 
                    @if ($order->return == 1)
                        Activa
                    @else
                        Inactiva
                    @endif
                </label>
            </div>
            <div class="flex">
                <label class="font-semibold">Fecha: {{ $order->created_at->format('d M Y') }}</label>
            </div>
    
            <div class="mt-2 border-t border-gray-200">
                <h2 class="text-xl">Objetos:</h2>

                @foreach ($things as $thing)
                    <p>- {{ $thing->name }} ({{ $thing->identifier }})</p>
                @endforeach
            </div>
        </div>
    </div>

</body>
</html>