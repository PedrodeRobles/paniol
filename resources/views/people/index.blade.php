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

    <div class="flex items-start mt-6 ml-4">
        <h1 class="text-center text-4xl">Registro de personal</h1>
    </div>

    <div class="border-2 border-gray-200 rounded-lg mx-2 md:mr-48 lg:mr-96 xl:w-1/2 my-10">
        <form action="{{ route('people.store') }}" method="POST">
            <div class="m-2 md:flex md:justify-around md:items-center">
                <div>
                    <label>Nombre</label>
                    <input class="bg-gray-700 w-full py-1" type="text" name="name">
                </div>
                <div>
                    <label>Apellido</label>
                    <input class="bg-gray-700 w-full py-1" type="text" name="last_name">
                </div>
                <div class="md:ml-2">
                    <label>Sector al que pertenece</label>
                    <input class="bg-gray-700 w-full py-1" type="text" name="place">
                </div>
                <div class="flex justify-end mt-3 md:ml-4">
                    <input class="bg-green-600 py-1 px-2 rounded-md" type="submit" value="Agregar">
                </div>
            @csrf
            </div>
        </form>
    </div>

    <div class="lg:w-12/12 xl:w-2/3 overflow-auto rounded-lg shadow mt-6 border-2 border-gray-300 mx-2 mb-10">
        <h2 class="text-2xl my-2 ml-2">Lista de personal</h2>
        
        <table class="w-full">
            <thead class="border-y-2 border-gray-200">
                <tr>
                    <th class="p-3 tracking-wide text-center border-r-2 border-gray-200">Nombre</th>
                    <th class="p-3 tracking-wide text-center border-r-2 border-gray-200">Apellido</th>
                    <th class="p-3 tracking-wide text-center border-r-2 border-gray-200">Sector</th>
                </tr>
                <tbody class="divide-y divide-gray-400">
                    @foreach ($person as $person)
                        <tr class="bg-gray-700 text-center">
                            <td class="p-2">{{ $person->name }}</td>
                            <td class="p-2">{{ $person->last_name }}</td>
                            <td class="p-2">{{ $person->place }}</td>
                            <td class="p-2">
                                <a class="py-1 px-2 bg-gray-600 rounded-md" href="{{ route('people.show', $person) }}">Ver</a>
                            </td>
                            <td class="p-2">
                                <form action="{{ route('people.destroy', $person) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input 
                                        class="bg-red-500 rounded px-2"
                                        type="submit"
                                        value="Delete"
                                        onclick="return confirm('¿Quieres eliminar a esta persona?')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </div>

</body>
</html>