<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f9fafb;
            color: #111827;
        }

        .invoice-container {
            max-width: 85rem;
            padding: 1.5rem;
            margin: 4rem auto;
        }

        .card {
            display: flex;
            flex-direction: column;
            padding: 1rem;
            background-color: #fff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
        }

        .card h1 {
            margin-top: 0.5rem;
            font-size: 1.25rem;
            font-weight: 600;
            color: #2563eb;
        }

        .card h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #4b5563;
        }

        .address {
            margin-top: 1rem;
            font-style: italic;
            color: #4b5563;
        }

        .grid-container {
            margin-top: 1rem;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .date-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }

        table {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #d1d5db;
        }

        .flex-container {
            margin-top: 1rem;
            display: flex;
            justify-content: flex-end;
        }

        .flex-container dl {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0.5rem;
        }

        .thank-you {
            margin-top: 1.5rem;
            font-size: 1.25rem;
            font-weight: 600;
            color: #4b5563;
        }

        .contact-info {
            margin-top: 0.5rem;
            color: #4b5563;
        }

        .copyright {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .buttons-container {
            margin-top: 0.75rem;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .button {
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .flex-container {
            display: flex;
            justify-content: flex-end; /* Align items to the end (right side) of the flex container */
        }

        .pdf-button {
            background-color: #fff;
            color: #374151;
        }

        .print-button {
            background-color: #2563eb;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="card">
        <h1>Car Service System.</h1>
        <div class="flex-container ">
            <div>
                <h2>Invoice # {{ $order->id }}</h2>
                <span>3682303</span>
                <address class="address">
                    Motor street<br>
                    128 a. Block 8a.<br>
                    Vilnius, Lithuania, 920567<br>
                </address>
            </div>
        </div>
        <div class="grid-container">
            <div>
                <h3>Bill to:</h3>
                <h3>Car Service System</h3>
                <address class="address">
                    Motor street,<br>
                    128 a. Block 8a<br>
                    Vilnius, Lithuania, 920567<br>
                    Bank Swedbank A/N LT342342343234<br>
                </address>
            </div>
            <div class="date-container">
                <dl>
                    <dt>Invoice date:</dt>
                    <dd>{{ now()->format('Y-m-d') }}</dd>
                </dl>
                <dl>
                    <dt>Due date:</dt>
                    <dd>{{ now()->addWeek()->format('Y-m-d') }}</dd>
                </dl>
            </div>
        </div>
        <table>
            <thead>
            <tr>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ $service->price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="flex-container">
            <div class="w-full max-w-2xl sm-text-end">
                <dl class="flex-container">
                    <dt>Tax:</dt>
                    <dd>{{ $order->total_tax }}</dd>
                </dl>
                <dl class="date-container">
                    <dt>Total:</dt>
                    <dd>{{ $order->total_price }}</dd>
                </dl>
            </div>
        </div>
        <div class="thank-you">Thank you!</div>
        <p>If you have any questions concerning this invoice, use the following contact information:</p>
        <div class="contact-info">
            <p>{{ config('mail.from.primary') }}</p>
            <p>+1 (062) 109-9222</p>
        </div>
        <p class="copyright">© {{ now()->format('Y') }} {{ config('app.name') }}.</p>
    </div>
</div>
</body>
</html>
