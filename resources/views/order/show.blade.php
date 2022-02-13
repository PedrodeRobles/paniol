<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <h1>Ver Orden</h1>

    {{-- Información de la Orden --}}
    <table>
        <thead>
            <tr>
                <th>Nombre herramienta</th>
            </tr>
            <tbody>
                @foreach ($things as $thing)
                    <tr>
                        @if ($thing->order_id == $order->id)
                        <td>{{ $thing->name }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </thead>
    </table>
</body>
</html>