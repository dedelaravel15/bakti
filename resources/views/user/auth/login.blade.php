<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login </title>
</head>
<body>
    @if (session()->has('login'))
        {{session('login')}}
    @endif
<form action="{{route('signin')}}" method="post">
    @csrf
    <input type="text" name="name" placeholder="Username"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Login</button>
</form>

<a href="{{route('register')}}">Belum punya akun?</a>
</body>
</html>
