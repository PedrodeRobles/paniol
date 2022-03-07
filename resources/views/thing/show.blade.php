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
        <a class="px-2 py-1 bg-blue-500 rounded-lg" href="{{ route('thing.index') }}">Volver</a>
    </div>

    <div class="h-14 flex items-start justify-center mt-6">
        <h1 class="text-4xl">Objeto del pañol</h1>
    </div>

    <div class="border-2 border-gray-300 rounded-lg bg-gray-900 mx-10 mt-4 mb-10">
        <div class="m-2 flex flex-col space-y-2">
            <div class="flex items-center">
                <p class="text-lg font-semibold">Nombre:</p>
                <p class="ml-2">{{ $thing->name }}</p>
            </div>

            <div class="flex items-center">
                <p class="text-lg font-semibold">Tipo de material:</p>
                <p class="ml-2">{{ $thing->type->type }}</p>
            </div>

            <div class="flex items-center">
                <p class="text-lg font-semibold">Estado:</p>
                @if ($thing->state == 1)
                    <p class="ml-2">En Pañol</p>
                @else
                    <p class="ml-2">En Uso</p>
                @endif
            </div>

            <div class="flex">
                <p class="text-lg font-semibold">Descripción:</p>
                <p class="ml-2 mt-1">{{ $thing->description }}</p>
            </div>
        </div>
    </div>
    

</body>
</html>