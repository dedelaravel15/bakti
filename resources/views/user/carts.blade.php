<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carts</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Produk</th>
                <th>Jumlah produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$cart->products->name}}</td>
                <td>{{$cart->amount}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{route('checkout')}}" method="post">
        @csrf
        <button type="submit">Checkout</button>
</form>
</body>
</html>
