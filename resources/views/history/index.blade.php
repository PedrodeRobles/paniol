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
        <h1 class="text-4xl">Historial de ordenes</h1>
    </div>

    {{-- TABLA DE ORDENES --}}
    <div class="lg:flex lg:justify-center">
        <div class="overflow-auto rounded-lg shadow mt-6 border-2 border-gray-300 mx-2 mb-10 lg:w-3/4 2xl:w-8/12">
            <h2 class="text-2xl my-2 ml-2">Lista de ordenes inactivas</h2>
    
            <table class="w-full">
                <thead class="border-y-2 border-gray-200">
                    <tr>
                        <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">ID</th>
                        <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Pesona</th>
                        <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Identificador</th>
                        <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Pañolero</th>
                        <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Fecha</th>
                        <th class="p-3 tracking-wide text-left border-r-2 border-gray-200">Fecha devolución</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-400">
                    @foreach ($histories as $history)
                        <tr class="bg-gray-700 text-center">
                            <td class="p-2">{{ $history->id }}</td>
                            <td class="p-2">{{ $history->person }}</td>
                            <td class="p-2">{{ $history->identifier }}</td>
                            <td class="p-2">{{ $history->user }}</td>
                            <td class="p-2">{{ $history->created_at->format('d M Y') }}</td>
                            <td class="p-2">{{ $history->updated_at->format('d M Y') }}</td>
                            <td class="p-2">
                                <a class="py-1 px-2 bg-gray-600 rounded-md" href="{{ route('history.show', $history) }}">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 mx-4">
                {{ $histories->links() }}
            </div>
        </div>
    </div>
</body>
</html>