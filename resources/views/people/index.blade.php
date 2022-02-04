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
        <input type="text" name="name">
        <input type="text" name="place">
        <input type="submit" value="Agregar">
        @csrf
    </form>
</body>
</html>