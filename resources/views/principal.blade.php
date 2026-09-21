<!DOCTYPE html>
<html>
<head>
    <title>Principal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Sistema de gestão do SAEP</h1>
    <hr>

    <h2>Bem-vindo, {{ session('usuario_nome') }}!</h2>

    <ul>
        <li><a href="/empresas/listar">Empresas</a></li>
        <li><a href="/salas/listar">Salas</a></li>
        <li><a href="/agendamentos/listar">Agendamentos</a></li>
    </ul>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Sair</button>
    </form>

</body>
</html>
