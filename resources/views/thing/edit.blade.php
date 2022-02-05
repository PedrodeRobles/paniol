<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>

    <form action="{{ route('thing.update', $thing) }}" method="POST" enctype="multipart/form-data">
        <label for="">Tipo de material *</label>
        <select name="type_id">
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->type }}</option>
            @endforeach
        </select>

        <label for="">Nombre *</label>
        <input type="text" name="name">

        <select name="state_id">
            @foreach ($states as $state)
                <option value="{{ $state->id }}">{{ $state->state }}</option>
            @endforeach
        </select>

        <label for="">Descripción</label>
        <textarea name="description" cols="30" rows="10"></textarea>

        @csrf
        @method('PUT')
        <input type="submit" value="Editar">
    </form>
</body>
</html>