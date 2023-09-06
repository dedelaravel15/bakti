<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
</head>
<body>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Pengguna</th>
            <th>Status</th>
            <th>Bukti pembayaran</th>
            <th>Aksi</th>
        </tr>
        @foreach ($order as $orders)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$orders->users->name}}</td>
            <td>
                @if ($orders->is_paid == false)
                    <p>Belum lunas</p>
                @else
                    <p>Lunas</p>
                @endif
            </td>
            <td>
                @if ($orders->payment_recipe == null)
                    <p>belum ada pembayaran</p>
                @elseif ($orders->is_paid)
                    {{$orders->is_paid}}
                @else
                    <a href="{{url('storage/'.$orders->payment_recipe)}}">Bukti pembayaran</a>
                @endif
            </td>
            <td>
                <form action="/confirm/{{$orders->id}}" method="post">
                    @method('patch')
                    @csrf
                    <button type="submit">Lunas kan</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
