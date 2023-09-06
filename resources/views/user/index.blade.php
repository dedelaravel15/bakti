<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda</title>
</head>
<body>
<a href="{{route('logout')}}">Logout</a><br>
<p>{{Auth::user()->name}}</p>
        @foreach ($products as $product)
            <a href="{{route('detail', $product)}}">
                <img src="{{url('storage/'.$product->image)}}" alt="gambar" height="100px" width="100px" title="{{$product->name}}">
            </a>
        @endforeach
</body>
</html>
