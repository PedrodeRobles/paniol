<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <form action="{{ route('type.store') }}" method="POST">
        <label for="">Tipo de material</label>
        <input type="text" name="type">
        <input type="submit" value="Agregar">
        @csrf
    </form>

    <table>
        <thead>
            <tr>
                <th>Tipos de materiales</th>
            </tr>
            <tbody>
                @foreach ($type as $type)
                    <tr>
                        <td>{{ $type->type }}</td>
                        <td>
                            <form action="{{ route('type.destroy', $type) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input 
                                    type="submit"
                                    value="Delete"
                                    onclick="return confirm('¿Estas seguro que quieres eliminar este tipo de material?')">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </thead>
    </table>
</body>
</html>