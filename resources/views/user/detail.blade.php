<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$product->name}}</title>
</head>
<body>
    @if (session()->has('cart'))
        {{session('cart')}}
    @endif
    <p><img src="{{url('storage/'.$product->image)}}" height="100px" width="100px"></p>
    <p>{{$product->name}}</p>
    <p>{{$product->price}}</p>

    <form action="{{route('add_cart', $product)}}" method="post">
        @csrf
        <input type="number" name="amount" id="">
        <button type="submit">Masuk ke keranjang</button>
    </form>
</body>
</html>
