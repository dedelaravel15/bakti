<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>order {{$order->user->name}}</title>
</head>
<body>

       <p> id {{$order->id}}</p>
       <p>Produk : </p>
        @foreach ($order->transactions as $transaction)
                <p>{{$transaction->product->name}}</p>
                <p>{{$transaction->product->price}}</p>
                <p>{{$transaction->amount}}</p>
                @php
                    $harga = $transaction->amount * $transaction->product->price
                @endphp
                <p>{{$harga}}</p>
        @endforeach

        @if ($order->is_paid == false)
            <p>Belum lunas</p>
        @else
            <p>lunas</p>
        @endif

        @if ($order->payment_recipe == null)
            <form action="/order/{{$order->id}}/pay" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <input type="file" name="file" id="">
                <button type="submit">Kirim</button>
            </form>
        @endif
</body>
</html>
