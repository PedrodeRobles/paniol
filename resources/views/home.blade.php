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
<body class="bg-zinc-800">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-14 my-10 mx-6">
        <a href="{{ route('thing.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-center rounded py-4 px-6 text-2xl shadow-lg">Objetos</a>
            
        <a href="{{ route('order.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-center rounded py-4 px-6 text-2xl shadow-lg">Ordenes</a>
            
        <a href="{{ route('people.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-center rounded py-4 px-6 text-2xl shadow-lg">Personal</a>

        <a href="{{ route('type.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-center rounded py-4 px-6 text-2xl shadow-lg">Tipos de elementos</a>
        @if (Route::has('login'))
            @auth
            <a href="{{url('backup') }}" class="bg-stone-500 hover:bg-stone-400 text-white text-center rounded py-4 px-6 text-2xl shadow-lg">Backup</a>
            @endauth
        @endif

    </div>

</body>
</html>