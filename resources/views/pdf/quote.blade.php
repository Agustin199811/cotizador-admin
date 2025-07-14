<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cotización</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #1A5275;
            margin: 0;
            padding: 0;
        }

        .header {
            background: linear-gradient(135deg, #1A5275, #5DADE2);
            color: white;
            padding: 20px;
            text-align: right;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logo {
            float: left;
            width: 100px;
            height: auto;
        }

        .info-section {
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        .info {
            width: 48%;
        }

        .info h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #1A5275;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px;
            font-size: 11px;
        }

        th {
            background-color: #1A5275;
            color: white;
            padding: 8px;
        }

        td {
            border: 1px solid #ddd;
            padding: 6px;
        }

        .totals {
            width: 200px;
            float: right;
            margin: 20px;
            text-align: right;
        }

        .totals table td {
            border: none;
            padding: 4px 8px;
        }

        .totals strong {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img class="logo" src="{{ public_path('img/login.png') }}" alt="Logo">
        <h1>COTIZACIÓN</h1>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="info-section">
        <div class="info">
            <h3>CLIENTE</h3>
            <p><strong>Nombre:</strong> {{ $quote->client_name }}</p>
            <p><strong>Email:</strong> {{ $quote->email }}</p>
        </div>
        <br>
        <br>
        <div class="info">
            <h3>FECHA</h3>
            <p><strong>N.º:</strong> {{ str_pad($quote->id, 5, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Emitida:</strong> {{ $quote->created_at->format('d \d\e F \d\e Y') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Material</th>
                <th>Precio m²</th>
                <th>Ancho (cm)</th>
                <th>Profundidad (cm)</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quote->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->category->name ?? '-' }}</td>
                    <td>{{ $item->materialPrice->material->name ?? '-' }}</td>
                    <td>${{ number_format($item->materialPrice->price_per_sqm, 2) }}</td>
                    <td>{{ $item->width }}</td>
                    <td>{{ $item->depth }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->unit_price, 2) }}</td>
                    <td>${{ number_format($item->total_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="totals">
        <table>
            <tr>
                <td><strong>TOTAL:</strong></td>
                <td><strong>${{ number_format($quote->total, 2) }}</strong></td>
            </tr>
        </table>
    </div>
</body>
</html>
