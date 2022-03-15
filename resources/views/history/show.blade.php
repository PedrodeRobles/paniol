<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    @foreach ($history->things as $history_thing)
        <p>{{ $history_thing->name }}</p>
    @endforeach
</body>
</html>