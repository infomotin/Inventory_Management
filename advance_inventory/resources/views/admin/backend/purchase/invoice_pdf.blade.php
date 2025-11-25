{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Purchase Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 20mm;
            background: #fff;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            page-break-inside: avoid;
        }

        .invoice-header {
            background-color: #0d6efd;
            /* Fallback for gradient */
            background: linear-gradient(135deg, #0d6efd, #17a2b8);
            color: #fff;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .info-section {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-section td {
            width: 33.33%;
            padding: 15px;
            vertical-align: top;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            margin: 0 5px;
        }

        .info-box h5 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #0d6efd;
        }

        .info-box p {
            margin: 5px 0;
            font-size: 12px;
        }

        .info-box p strong {
            color: #555;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        .table th {
            background: #e9ecef;
            font-weight: bold;
            color: #333;
        }

        .table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        .summary-table {
            width: 50%;
            margin-left: auto;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 5px;
            text-align: right;
            font-weight: bold;
            border: none;
            font-size: 12px;
        }

        @page {
            margin: 20mm;
        }

        @media print {
            .invoice-container {
                border: none;
                padding: 0;
            }

            .info-section td {
                background: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h5>Purchase Invoice</h5>
        </div>

        <table class="info-section">
            <tr>
                <td class="info-box">
                    <h5>Supplier Info</h5>
                    <p><strong>Name:</strong> {{ $purchase->supplier->name }} </p>
                    <p><strong>Email:</strong> {{ $purchase->supplier->email }}</p>
                    <p><strong>Phone:</strong> {{ $purchase->supplier->phone }} </p>
                </td>
                <td class="info-box">
                    <h5>Warehouse</h5>
                    <p>{{ $purchase->warehouse->name }} </p>
                </td>
                <td class="info-box">
                    <h5>Purchase Info</h5>
                    <p><strong>Date:</strong> {{ $purchase->date }} </p>
                    <p><strong>Status:</strong> {{ $purchase->status }} </p>
                    <p><strong>Grand Total:</strong> ${{ number_format($purchase->grand_total, 2) }} </p>
                </td>
            </tr>
        </table>

        <h5 style="font-weight: bold; margin: 20px 0 10px;">Order Summary</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Net Unit Cost</th>
                    <th>Discount</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchase->purchaseItems as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->net_unit_cost, 2) }}</td>
                        <td>${{ number_format($item->discount, 2) }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="summary-table">
            <tr>
                <td><strong>Total Discount:</strong> ${{ number_format($purchase->discount, 2) }} </td>
            </tr>
            <tr>
                <td><strong>Shipping Cost:</strong> ${{ number_format($purchase->shipping, 2) }} </td>
            </tr>
            <tr>
                <td><strong>Grand Total:</strong> ${{ number_format($purchase->grand_total, 2) }} </td>
            </tr>
        </table>
    </div>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Invoice</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background-color: #fff;
            margin: 0;
            padding: 20px;
        }

        /* Header Section */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .invoice-number {
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 5px;
        }

        .company-logo {
            max-height: 70px;
        }

        /* Info Sections */
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .info-box {
            flex: 1;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 6px;
            margin: 0 10px;
        }

        .info-box:first-child {
            margin-left: 0;
        }

        .info-box:last-child {
            margin-right: 0;
        }

        .info-box h3 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }

        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 13px;
        }

        .table th {
            background-color: #f8f9fa;
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border: 1px solid #dee2e6;
        }

        .table td {
            padding: 12px 10px;
            border: 1px solid #dee2e6;
            vertical-align: top;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Summary Section */
        .summary-section {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }

        .summary-table {
            width: 300px;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 10px 15px;
            border: 1px solid #dee2e6;
        }

        .summary-table .label {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .summary-table .total {
            font-weight: 700;
            font-size: 15px;
            color: #2c3e50;
            background-color: #f0f7ff;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-received {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-ordered {
            background-color: #cce5ff;
            color: #004085;
        }

        /* Utility Classes */
        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: 600;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mt-0 {
            margin-top: 0;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .p-0 {
            padding: 0;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            color: #7f8c8d;
            font-size: 12px;
        }

        /* Print Styles */
        @media print {
            body {
                padding: 0;
                font-size: 12px;
            }

            .no-print {
                display: none !important;
            }

            .table th {
                background-color: #f8f9fa !important;
                -webkit-print-color-adjust: exact;
            }

            .summary-table .label {
                background-color: #f8f9fa !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <div>
            <h1 class="invoice-title">PURCHASE INVOICE</h1>
            <div class="invoice-number">#{{ str_pad($purchase->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>
        <img src="{{ public_path('backend/assets/images/logo/logo.png') }}" alt="Company Logo" class="company-logo">
    </div>

    <div class="info-section">
        <div class="info-box">
            <h3>Supplier Information</h3>
            <div class="text-bold">{{ $purchase->supplier->name }}</div>
            <div>{{ $purchase->supplier->email }}</div>
            <div>{{ $purchase->supplier->phone }}</div>
            <div>{{ $purchase->supplier->address }}</div>
        </div>

        <div class="info-box">
            <h3>Company Information</h3>
            <div class="text-bold">{{ config('app.name') }}</div>
            <div>{{ $purchase->warehouse->name }} Warehouse</div>
            <div>Invoice Date: {{ \Carbon\Carbon::parse($purchase->date)->format('M d, Y') }}</div>
            <div>Status:
                @php
                    $statusClass =
                        [
                            'Received' => 'status-received',
                            'Pending' => 'status-pending',
                            'Ordered' => 'status-ordered',
                        ][$purchase->status] ?? 'status-pending';
                @endphp
                <span class="status-badge {{ $statusClass }}">{{ $purchase->status }}</span>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Discount</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase->purchaseItems as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="text-bold">{{ $item->product->name }}</div>
                        <div style="color: #7f8c8d; font-size: 12px;">{{ $item->product->code }}</div>
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">${{ number_format($item->net_unit_cost, 2) }}</td>
                    <td class="text-right">${{ number_format($item->discount, 2) }}</td>
                    <td class="text-right">${{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-section">
        <table class="summary-table">
            <tr>
                <td class="label">Subtotal</td>
                <td class="text-right">
                    ${{ number_format($purchase->grand_total - $purchase->shipping + $purchase->discount, 2) }}</td>
            </tr>
            @if ($purchase->discount > 0)
                <tr>
                    <td class="label">Discount</td>
                    <td class="text-right">-${{ number_format($purchase->discount, 2) }}</td>
                </tr>
            @endif
            @if ($purchase->shipping > 0)
                <tr>
                    <td class="label">Shipping</td>
                    <td class="text-right">${{ number_format($purchase->shipping, 2) }}</td>
                </tr>
            @endif
            <tr>
                <td class="label total">Grand Total</td>
                <td class="text-right total">${{ number_format($purchase->grand_total, 2) }}</td>
            </tr>
        </table>
    </div>

    @if ($purchase->note)
        <div class="mt-20" style="padding: 15px; background-color: #f9f9f9; border-radius: 6px;">
            <div class="text-bold" style="margin-bottom: 8px;">Notes:</div>
            <div class="mb-0">{{ $purchase->note }}</div>
        </div>
    @endif

    <div class="footer">
        <div>Thank you for your business!</div>
        <div>{{ config('app.name') }} | {{ config('app.url') }}</div>
    </div>
</body>

</html>
