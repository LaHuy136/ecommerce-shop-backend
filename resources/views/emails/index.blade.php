<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background: #f4f4f4;
        }
    </style>
</head>

<body>

    <h2>Order Information</h2>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
                <tr>
                    <td>
                        <img src="{{ asset('storage/products/85x84/' . $item['image']) }}" width="60">
                    </td>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <table width="100%">
        <tr>
            <td><strong>Shipping Cost</strong></td>
            <td align="right">Free</td>
        </tr>
        <tr>
            <td><strong>Total</strong></td>
            <td align="right"><strong>${{ number_format($total, 2) }}</strong></td>
        </tr>
    </table>

    <p>Thank you for your order ❤️</p>

</body>

</html>
