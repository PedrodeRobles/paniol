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
                <h2 class="text-xl">Generar backup</h2>
            </div>
    
            <div class="m-2">
                <div class="border-b border-gray-400 pb-2">
                    <label>Paso 1)</label>
                    <p>Abrir el Símbolo de sistema de Windows</p>
                </div>
                <div class="border-b border-gray-400 py-2">
                    <label>Paso 2)</label>
                    <p>Escribir:</p>
                    <p class="bg-gray-800">cd \</p>
                </div>
                <div class="border-b border-gray-400 py-2">
                    <label>Paso 3)</label>
                    <p>Escribir:</p>
                    <p class="bg-gray-800">cd xampp\htdocs\paniol</p>
                </div>
                <div class="border-b border-gray-400 py-2">
                    <label>Paso 4)</label>
                    <p>Escribir:</p>
                    <p class="bg-gray-800">php artisan backup:run</p>
                    <Label>Aparecera lo siguiente:</Label>
                    <img src="{{ asset('/img/backupRun.png') }}" alt="backupRun" class="mb-2">
                    <p>Se va a generar una carpeta llamada 'backup-paniol' en el escritorio</p>
                </div>
                <div class="border-b border-gray-400 py-2">
                    <label>Paso 5)</label>
                    <p>Subir la carpeta al drive (Si la carpeta ya exíste en el drive reemplazarla)</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>