<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pañol</title>
</head>
<body>
    <h1>GENERAR PEDIDO</h1>

    {{-- FORMULARIO PARA GENERAR ORDENES --}}
    <h2>Formulario</h2>
    <form action="{{ route('transaction.store') }}" method="POST">
        <label for="">Identificador de orden</label>
        <select name="order_id">
            @foreach ($orders as $order)
                <option value="{{ $order->id }}">{{ $order->identifier }}</option>
            @endforeach
        </select>

        <label for="">Persona que retira pedido</label>
        <select name="person_id">
            @foreach ($people as $person)
                <option value="{{ $person->id }}">{{ $person->name }}</option>
            @endforeach
        </select>

        <input type="submit" value="Agregar">
        @csrf
    </form>


    {{-- TABLA DE ORDENES --}}
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Identificador</th>
            </tr>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->person->name }}</td>
                        <td>
                            {{ $transaction->order->identifier}}
                        </td>
                        <td>
                            <button><a href="{{ route('transaction.show', $transaction) }}">Ver</a></button>
                        </td>
                        <td>
                            <button><a href="{{ route('transaction.edit', $transaction) }}">Editar</a></button>
                        </td>
                        <td>
                            <form action="{{ route('transaction.destroy', $transaction) }}" method="POST">
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