
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah data</title>
</head>
<body>
    <form action="{{route('store_product')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id=""><br>
        <input type="text" name="description" id=""><br>
        <input type="text" name="price" id=""><br>
        <input type="text" name="stock" id=""><br>
        <input type="file" name="image" id="image"><br>

        <div class="preview" id="preview">

        </div>
        <button type="submit">Tambah</button>
    </form>
<script src="{{asset('js/create.js')}}"></script>
</body>
</html>
