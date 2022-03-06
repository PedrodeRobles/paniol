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
    <h1 class="text-3xl">Copia de seguridad</h1>

    <div>
        <p class="text-lg">Exportar tablas</p>

        <div class="text-black">
            <button class="bg-gray-300 rounded px-2">
                <a href="{{ route('orders.excel') }}">Exportar ordenes</a>
            </button>
    
            <button class="bg-gray-300 rounded px-2">
                <a href="{{ route('thing.excel') }}">Exportar objetos</a>
            </button>
    
            <button class="bg-gray-300 rounded px-2">
                <a href="{{ route('people.excel') }}">Exportar personal</a>
            </button>
    
            <button class="bg-gray-300 rounded px-2">
                <a href="{{ route('type.excel') }}">Exportar tipos de objetos</a>
            </button>
    
            <button class="bg-gray-300 rounded px-2">
                <a href="{{ route('user.excel') }}">Exportar usuarios</a>
            </button>
        </div>
    </div>

    <div>
        <p class="text-lg">Importar tablas</p>

        <form action="{{ route('orders.import.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button>Importar ordenes</button>
        </form>

        <form action="{{ route('things.import.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button>Importar objetos</button>
        </form>

        <form action="{{ route('people.import.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button>Importar personal</button>
        </form>

        <form action="{{ route('types.import.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button>Importar tipos de objetos</button>
        </form>

        <form action="{{ route('users.import.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button>Importar usuarios</button>
        </form>
    </div>

</body>
</html>