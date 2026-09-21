<!DOCTYPE html>
<html>
<head>
    <title>Nova empresa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Nova empresa</h1>

    <a href="/empresas/listar">Voltar</a>

    @foreach($errors->all() as $erro)
        <p>{{ $erro }}</p>
    @endforeach

    <form action="/empresas" method="POST">
        @csrf

        <label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome') }}">
        <br><br>

        <label>CNPJ:</label>
        <input type="text" name="cnpj" value="{{ old('cnpj') }}" maxlength="18">
        <br><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="{{ old('telefone') }}">
        <br><br>

        <label>E-mail:</label>
        <input type="email" name="email" value="{{ old('email') }}">
        <br><br>

        <button type="submit">Salvar</button>
    </form>

</body>
</html>
