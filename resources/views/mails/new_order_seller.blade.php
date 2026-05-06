<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: white; padding: 32px; border-radius: 12px; max-width: 600px; margin: auto; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th { background: #f0f0f0; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .total { font-size: 1.2rem; font-weight: bold; color: #4f6ef7; }
        .footer { color: #999; font-size: 12px; margin-top: 24px; }
    </style>
</head>
<body>
<div class="container">
    <h2>🛒 У вас новый заказ!</h2>
    <p>Покупатель <strong>{{ $customerName }}</strong> оформил заказ на ваши товары:</p>

    <table>
        <tr>
            <th>Товар</th>
            <th>Кол-во</th>
            <th>Сумма</th>
        </tr>
        @foreach($items as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
        </tr>
        @endforeach
    </table>

    <p class="total">Итого: ${{ number_format($total, 2) }}</p>
    <p class="footer">TechMinimal — не отвечайте на это письмо</p>
</div>
</body>
</html>
