<!DOCTYPE html>
<html>
<head>
    <title>Empresas</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Empresas</h1>

    <a href="/principal">Voltar</a> |
    <a href="/empresas/create">Nova empresa</a>

    <br><br>

    @if(session('sucesso'))
        <p>{{ session('sucesso') }}</p>
    @endif

    @if(session('erro'))
        <p>{{ session('erro') }}</p>
    @endif

    <form action="/empresas/listar" method="GET">
        <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar empresa">
        <button type="submit">Buscar</button>
    </form>

    <br>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>

        @forelse($empresas as $empresa)
            <tr>
                <td>{{ $empresa->id }}</td>
                <td>{{ $empresa->nome }}</td>
                <td>{{ $empresa->cnpj }}</td>
                <td>{{ $empresa->telefone }}</td>
                <td>{{ $empresa->email }}</td>
                <td>
                    <a href="/empresas/{{ $empresa->id }}/edit">Editar</a>
                    <form action="/empresas/{{ $empresa->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Nenhuma empresa encontrada.</td>
            </tr>
        @endforelse
    </table>

</body>
</html>
