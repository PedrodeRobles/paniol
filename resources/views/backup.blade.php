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
    <div class="flex justify-between bg-blue-500 h-20 border-b-2 border-t-2 border-black">
        <a href="{{ url('/') }}" class="w-44">
            <img src="{{ asset('/img/logoCitlam.png') }}" alt="Logo Citlam" class="mb-2">
        </a>
        <h1 class="text-center text-6xl mr-20">Pañol</h1>
        <div>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>

    <h1 class="text-3xl">Copia de seguridad</h1>

    <div>
        <p class="text-lg">Exportar tablas</p>

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