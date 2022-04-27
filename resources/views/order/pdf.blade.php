<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
    <title>Comprobante orden PAÑOL</title>
</head>
<body>

    <div>
        <img src="{{ asset('/img/logoCitlam.png') }}" alt="Logo Citlam" class="logo-citlam">
        <img src="{{ asset('/img/laMatanzaLogo.png') }}" alt="Logo de La Matanza" class="logo-matanza">
    </div>

    <div>
        <h1>
            <u>COMPROBANTE DE ORDEN</u>
        </h1>
    </div>

    {{-- Información de la Orden --}}
    <div >
        <h2>
            Datos de la orden
        </h2>

        <table>
            <thead>
                <tr>
                    <th>ID de la orden</th>
                    <th>Persona</th>
                    <th>Sector</th>
                    <th>Identificador</th>
                    <th>Pañolero</th>
                    <th>Estado de orden</th>
                    <th class="fecha">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->person->name }} {{ $order->person->last_name }}</td>
                    <td>{{ $order->person->place }}</td>
                    <td>{{ $order->identifier }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        @if ($order->return == 1)
                            Activa
                        @else
                            Inactiva
                        @endif
                    </td>
                    <td  class="fecha">{{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="firma">
            <p>Firma del responsable:_________________________</p>
            <p>Aclaración:_________________________</p>
        </div>

        <div>

        </div>

        <div>
            <>
                <h2>OBJETOS:</h2>

                {{-- @foreach ($things as $thing)
                        <b class="thing">{{ $thing->name }} ({{ $thing->identifier }})</b>
                @endforeach --}}

                
                <table>
                    @foreach ($things as $thing)
                    <tbody class="things">
                        <td>{{ $thing->name }}</td>
                        <td>({{ $thing->identifier }})</td>
                    </tbody>
                    @endforeach

                </table>

            </div>
        </div>
    </div>

</body>
</html>