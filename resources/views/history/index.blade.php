<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Pesona</th>
                <th>Identificador</th>
                <th>Pañolero</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td>{{ $history->person }}</td>
                    <td>{{ $history->identifier }}</td>
                    <td>{{ $history->user }}</td>
                    <td>
                        <a href="{{ route('history.show', $history) }}">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>