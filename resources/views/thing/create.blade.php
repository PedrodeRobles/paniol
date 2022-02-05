<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <form action="{{ route('thing.store') }}" method="POST">
        <label for="">Tipo de material *</label>
        <select name="type_id">
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->type }}</option>
            @endforeach
        </select>


        <label for="">Nombre *</label>
        <input type="text" name="name">
        <label for="">Descripción</label>
        <textarea name="description" cols="30" rows="10"></textarea>
        <input type="submit" value="Agregar">
        @csrf
    </form>
</body>
</html>