<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produk Admin</title>
</head>
<body>
<a href="{{route('add_product')}}">Tambah produk</a>
   <table>
        <tr>
            <td>No</td>
            <td>Nama Produk</td>
            <td>Harga</td>
            <td>Deskripsi</td>
            <td>stok</td>
            <td>Gambar</td>
            <td>Aksi</td>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->stock}}</td>
            <td><img src="{{url('storage/'.$product->image)}}" alt="" srcset="" height="100px" width="100px"></td>
            <td>
                <form action="{{route('edit', $product)}}" method="get">
                    @csrf
                    <button type="submit">Edit</button>
                </form>
                <form action="{{route('delete', $product)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Edit</button>
                </form>
            </td>
        </tr>
        @endforeach
   </table>
</body>
</html>
