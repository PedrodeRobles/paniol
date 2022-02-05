<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <form action="{{ route('state.store') }}" method="POST">
        <label for="">Estado</label>
        <input type="text" name="state">
        <input type="submit" value="Agregar">
        @csrf
    </form>

    <table>
        <thead>
            <tr>
                <th>Estados del material</th>
            </tr>
            <tbody>
                @foreach ($state as $state)
                    <tr>
                        <td>{{ $state->state }}</td>
                        <td>
                            <form action="{{ route('state.destroy', $state) }}" method="POST">
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