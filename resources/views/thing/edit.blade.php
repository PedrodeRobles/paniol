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
                Editar Objeto
            </h1>
            <form action="{{ route('thing.update', $thing) }}" method="POST" enctype="multipart/form-data">


                <div class="flex flex-col">
                    <label class="text-lg">Nombre *</label>
                    <input class="bg-gray-700" type="text" name="name" value="{{ old('name', $thing->name) }}">
                </div>
        
                {{-- <select name="state_id">
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->state }}</option>
                    @endforeach
                </select> --}}
                
                <div class="flex flex-col">
                    <label class="text-lg">Descripción</label>
                    <textarea class="bg-gray-700" name="description" cols="30" rows="3">{{ old('description' ,$thing->description) }}</textarea>
                </div>

                <div class="flex justify-end mt-6">
                    <input class="bg-blue-600 py-2 px-4 rounded-md" type="submit" value="Editar">
                </div>

                @csrf
                @method('PUT')
            </form>
        </div>
    </div>
    
</body>
</html>