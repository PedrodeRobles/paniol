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

    <div class="grid grid-cols-4 gap-14 mt-10 mx-4">
        <a href="{{ route('thing.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-center rounded py-4 px-6 text-2xl">Objetos</a>
            
        <a href="{{ route('order.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-center rounded py-4 px-6 text-2xl">Ordenes</a>
            
        <a href="{{ route('people.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-center rounded py-4 px-6 text-2xl">Personal</a>

        <a href="{{ route('type.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-center rounded py-4 px-6 text-2xl">Tipos de elementos</a>
    </div>

</body>
</html>