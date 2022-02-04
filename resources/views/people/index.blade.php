<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <form action="{{ route('people.store') }}" method="POST">
        <label for="">Nombre y Apellido</label>
        <input type="text" name="name">
        <label for="">Sector al que pertenece</label>
        <input type="text" name="place">
        <input type="submit" value="Agregar">
        @csrf
    </form>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Sector</th>
            </tr>
            <tbody>
                @foreach ($people as $person)
                    <tr>
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->place }}</td>
                    </tr>
                @endforeach
            </tbody>
        </thead>
    </table>
</body>
</html>