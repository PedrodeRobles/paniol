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

    <div class="h-14 flex items-start mt-6 ml-4">
        <h1 class="text-center text-4xl">Administración de roles</h1>
    </div>

    {{-- TABLA DE OBJETOS --}}
    <div class="my-10 border-2 border-gray-200 rounded-lg mx-4">
        {{-- Search form --}}
        <div class="mt-4 sm:ml-4">
            <h2 class="text-xl mb-2">Buscar usuario</h2>
            <form>
                <input class="bg-gray-700 rounded-md py-1" type="search" name="search" placeholder="Buscar" class="rounded-md py-1 text-black">
                <button type="submit" class="bg-gray-600 rounded py-1 px-1">Buscar</button>
            </form>
        </div>

        <div class="overflow-auto rounded-lg shadow mt-6">
            <table class="w-full">
                <thead class="border-y-2 border-gray-200">
                    <tr>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">ID</th>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Nombre</th>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Rol</th>
                        <th class="p-3 tracking-wide text-left border-r border-gray-200">Cambiar rol</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="bg-blue-500">
                            <td class="p-2 border-r border-gray-200">{{ $user->id }}</td>
                            <td class="p-2 border-r border-gray-200">{{ $user->name }}</td>
                            <td class="p-2 border-r border-gray-200">{{ $user->role->role}}</td>
                            <form action="{{ route('updateRole', $user) }}" method="POST">
                                <td class="p-2 border-r border-gray-200">
                                    <select class="bg-gray-700" name="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                    <button class="p-2 rounded-lg bg-sky-700 hover:bg-sky-600">
                                        Actualizar
                                    </button>
                                </td>
                                @csrf
                                @method('PUT')
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>