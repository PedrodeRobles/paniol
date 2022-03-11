<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <p>{{ $person->id }}</p>
    <p>{{ $person->name }}</p>
    @foreach ($orders as $order)
        <p>{{ $order->id }}</p>
    @endforeach
</body>
</html>