<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Login</h1>

    @if(session('erro'))
        <p>{{ session('erro') }}</p>
    @endif

    @if(session('sucesso'))
        <p>{{ session('sucesso') }}</p>
    @endif

    @foreach($errors->all() as $erro)
        <p>{{ $erro }}</p>
    @endforeach

    <form action="/login" method="POST">

        @csrf

        <label>E-mail:</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <br><br>

        <label>Senha:</label>
        <input type="password" name="senha">

        <br><br>

        <button type="submit">Entrar</button>

    </form>

</body>
</html>
