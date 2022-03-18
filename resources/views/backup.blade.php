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

<body class="bg-zinc-800 text-white">
    <div class="ml-2 mt-4">
        <a class="px-2 py-1 bg-blue-500 rounded-lg" href="{{ url('/') }}">Volver</a>
    </div>

    <div class="h-14 flex justify-center items-start mt-6 ml-4">
        <h1 class="text-center text-4xl">Copia de Seguridad</h1>
    </div>

    {{-- EXPORTAR TABLAS --}}
    <div class="lg:flex lg:justify-center ">
        <div class="border-2 border-gray-600 rounded-lg bg-green-600 mx-4">

            <div class="border-b-2 border-gray-600 flex justify-center py-1 ml-2">
                <h2 class="text-xl">Exportar tablas (Importante subir al drive)</h2>
            </div>
    
            <div class="m-2 grid grid-cols-2 md:grid-cols-4 gap-4 lg:flex">
                <div>
                    <a class="bg-gray-600 rounded-md py-1 px-2" href="{{ route('user.excel') }}">Exportar usuarios</a>
                </div>
                <div>
                    <a class="bg-gray-600 rounded-md py-1 px-2" href="{{ route('type.excel') }}">Exportar tipos de objetos</a>
                </div>
                <div>
                    <a class="bg-gray-600 rounded-md py-1 px-2" href="{{ route('people.excel') }}">Exportar personal</a>
                </div>
                <div>
                    <a class="bg-gray-600 rounded-md py-1 px-2" href="{{ route('orders.excel') }}">Exportar ordenes</a>
                </div>
                <div>
                    <a class="bg-gray-600 rounded-md py-1 px-2" href="{{ route('thing.excel') }}">Exportar objetos</a>
                </div>
                <div>
                    <a class="bg-gray-600 rounded-md py-1 px-2" href="{{ route('histories.excel') }}">Exportar historial</a>
                </div>
            </div>
        </div>
    </div>

    {{-- IMPORTAR TABLAS --}}
    <div class="lg:flex lg:justify-center my-10">
        <div class="border-2 border-gray-600 rounded-lg bg-red-600 mx-4">

            <div class="border-b-2 border-gray-600 flex justify-center py-1 ml-2">
                <h2 class="text-xl">Importar tablas (advertencia: Importar en orden)</h2>
            </div>
    
            <div class="m-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="border-b border-gray-300">
                    <form action="{{ route('users.import.excel') }}" method="POST" enctype="multipart/form-data">
                        <label>1)</label>
                        @csrf
                        <input type="file" name="file">
                        <button class="bg-gray-600 rounded-md py-1 px-2 my-2">Importar usuarios</button>
                    </form>
                </div>
                <div class="border-b border-gray-300">
                    <form action="{{ route('types.import.excel') }}" method="POST" enctype="multipart/form-data">
                        <label>2)</label>
                        @csrf
                        <input type="file" name="file">
                        <button class="bg-gray-600 rounded-md py-1 px-2 my-2">Importar tipos de objetos</button>
                    </form>
                </div>
                <div class="border-b border-gray-300">
                    <form action="{{ route('people.import.excel') }}" method="POST" enctype="multipart/form-data">
                        <label>3)</label>
                        @csrf
                        <input type="file" name="file">
                        <button class="bg-gray-600 rounded-md py-1 px-2 my-2">Importar personal</button>
                    </form>
                </div>
                <div class="border-b border-gray-300">
                    <form action="{{ route('orders.import.excel') }}" method="POST" enctype="multipart/form-data">
                        <label>4)</label>
                        @csrf
                        <input type="file" name="file" >
                        <button class="bg-gray-600 rounded-md py-1 px-2 my-2">Importar ordenes</button>
                    </form>
                </div>
                <div class="border-b border-gray-300">
                    <form action="{{ route('things.import.excel') }}" method="POST" enctype="multipart/form-data">
                        <label>5)</label>
                        @csrf
                        <input type="file" name="file">
                        <button class="bg-gray-600 rounded-md py-1 px-2 my-2">Importar objetos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>