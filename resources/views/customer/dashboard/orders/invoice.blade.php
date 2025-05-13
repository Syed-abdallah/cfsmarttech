<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #4b5563;
            --accent: #059669;
            --light-bg: #f9fafb;
            --border: #e5e7eb;
            --text-dark: #111827;
            --text-medium: #374151;
            --text-light: #9ca3af;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            color: var(--text-medium);
            background-color: white;
            padding: 0;
            margin: 0;
            font-size: 14px;
        }
        
        .page {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }
        
        .header {
            margin-bottom: 30px;
        }
        
        .company-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 20px;
        }
        
        .company-info {
            font-size: 13px;
            color: var(--secondary);
        }
        
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .invoice-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }
        
        .invoice-meta {
            margin-top: 30px;
            text-align: right;
            font-size: 13px;
            color: var(--secondary);
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            background-color: #fee2e2;
            color: #b91c1c;
            text-transform: uppercase;
        }
        
        .client-payment-row {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            font-size: 13px;
        }
        
        .client-info, .payment-info {
            flex: 1;
        }
        
        .info-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }
        
        th {
            text-align: left;
            padding: 12px 15px;
            background-color: var(--light-bg);
            color: var(--text-dark);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border);
        }
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .summary {
            float: right;
            width: 300px;
            margin-top: 20px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
        }
        
        .summary-row:last-child {
            border-bottom: none;
            font-weight: 600;
            padding-top: 12px;
        }
        
        .total {
            color: var(--primary);
            font-weight: 700;
        }
        
        .notes {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            color: var(--secondary);
            line-height: 1.7;
            font-size: 13px;
        }
        
        .footer {
            margin-top: 50px;
            text-align: center;
            color: var(--text-light);
            font-size: 13px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        
        .payment-instructions {
            margin-top: 30px;
            background-color: var(--light-bg);
            padding: 15px;
            border-radius: 6px;
            font-size: 13px;
            line-height: 1.7;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="company-header">
                <div class="company-info">
                    <strong>YourCompany</strong> | 123 Business Avenue, Suite 100 | San Francisco, CA 94107 | Tax ID: US123456789 | billing@yourcompany.com
                </div>
            </div>
            
            <div class="invoice-header">
                <h1 class="invoice-title">INVOICE</h1>
                <div class="invoice-meta">
                    #{{ $order->order_number }} | Issued: {{ $order->created_at->format('M d, Y') }} | 
                    <span class="status-badge">{{ strtoupper($order->status ?? 'CANCELLED') }}</span>
                </div>
            </div>
        </div>
        
        <div class="client-payment-row">
            <div class="client-info">
                <div class="info-label">Bill To</div>
                <div>{{ $order->customer_name ?? 'Customer Name' }} | {{ $order->customer_email ?? 'customer@example.com' }} | {{ $order->customer_phone ?? '+1234567890' }}</div>
            </div>
            
            <div class="payment-info">
                <div class="info-label">Payment Details</div>
                <div>Due: {{ $order->created_at->addDays(15)->format('M d, Y') }} | Method: {{ $order->payment_method ?? 'bank-transfer' }} | Terms: Net 15</div>
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product_name }}</strong><br>
                        <span style="color: var(--text-light);">SKU: {{ $item->sku ?? 'N/A' }}</span>
                    </td>
                    <td class="text-right">${{ number_format($item->price, 2) }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">${{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="summary">
            <div class="summary-row">
                <span>Subtotal</span>
                <span>${{ number_format($order->subtotal ?? $order->total_amount, 2) }}</span>
            </div>
            @if(isset($order->tax) && $order->tax > 0)
            <div class="summary-row">
                <span>Tax ({{ $order->tax_rate ?? 0 }}%)</span>
                <span>${{ number_format($order->tax, 2) }}</span>
            </div>
            @endif
            @if(isset($order->shipping) && $order->shipping > 0)
            <div class="summary-row">
                <span>Shipping</span>
                <span>${{ number_format($order->shipping, 2) }}</span>
            </div>
            @endif
            @if(isset($order->discount) && $order->discount > 0)
            <div class="summary-row">
                <span>Discount</span>
                <span>-${{ number_format($order->discount, 2) }}</span>
            </div>
            @endif
            <div class="summary-row">
                <span>Total</span>
                <span class="total">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>
        
        <div class="payment-instructions">
            <strong>Payment Instructions:</strong> Please make checks payable to YourCompany Inc. and include invoice number. For wire transfers: Bank Name (Routing: 123456789, Account: 987654321)
        </div>
        
        <div class="notes">
            <strong>Notes:</strong> Payment is due within 15 days of invoice date. A 1.5% monthly service charge will be applied to overdue balances. Thank you for your business!
        </div>
        
        <div class="footer">
            <div>YourCompany Inc. • 123 Business Avenue, San Francisco, CA 94107</div>
            <div>billing@yourcompany.com • (555) 123-4567 • www.yourcompany.com</div>
            <div style="margin-top: 10px;">This is an electronically generated invoice and does not require a signature.</div>
        </div>
    </div>
</body>
</html>