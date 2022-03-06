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
    <div class="border-2 border-gray-200 rounded-lg mx-2 md:mx-24 my-10">
        <div class="m-4">
            <h1 class="text-3xl my-6">
                Agregar objeto al pañol
            </h1>

            <form action="{{ route('thing.store') }}" method="POST">
                <div class="flex flex-col">
                    <label class="text-lg">Tipo de material *</label>
                    <select class="bg-gray-700" name="type_id">
                        @foreach ($types as $type)
                            <option class="text-black" value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="flex flex-col">
                    <label class="text-lg">Nombre *</label>
                    <input class="bg-gray-700" type="text" name="name">
                </div>
    
                <div class="flex flex-col">
                    <label class="text-lg">Descripción</label>
                    <textarea class="bg-gray-700" name="description" cols="20" rows="3"></textarea>
                </div>
                
                <div class="flex justify-end mt-6">
                    <input class="bg-green-600 py-2 px-4 rounded-md" type="submit" value="Agregar">
                </div>
                @csrf
            </form>
        </div>
    </div>
</body>
</html>