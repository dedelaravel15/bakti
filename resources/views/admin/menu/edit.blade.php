
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit {{$product->name}}</title>
</head>
<body>
    <form action="{{route('update', $product)}}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <input type="text" name="name" id="" value="{{$product->name}}"><br>
        <input type="text" name="description" id="" value="{{$product->description}}"><br>
        <input type="text" name="price" id="" value="{{$product->price}}"><br>
        <input type="text" name="stock" id="" value="{{$product->stock}}"><br>
        <img src="{{url('storage/'.$product->image)}}" alt="gambar" height="50px" width="50px">
        <input type="file" name="image" id=""><br>
        <button type="submit">Ubah</button>
    </form>
</body>
</html>
