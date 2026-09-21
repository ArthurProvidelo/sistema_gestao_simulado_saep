<!DOCTYPE html>
<html>
<head>
    <title>Salas</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Salas</h1>

    <a href="/principal">Voltar</a> |
    <a href="/salas/create">Nova sala</a>

    <br><br>

    @if(session('sucesso'))
        <p>{{ session('sucesso') }}</p>
    @endif

    @if(session('erro'))
        <p>{{ session('erro') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Sala</th>
            <th>Bloco</th>
            <th>Empresa</th>
            <th>Ações</th>
        </tr>

        @forelse($salas as $sala)
            <tr>
                <td>{{ $sala->id }}</td>
                <td>{{ $sala->num_sala }}</td>
                <td>{{ $sala->bloco }}</td>
                <td>{{ $sala->empresa->nome }}</td>
                <td>
                    <a href="/salas/{{ $sala->id }}/edit">Editar</a>
                    <form action="/salas/{{ $sala->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Nenhuma sala cadastrada.</td>
            </tr>
        @endforelse
    </table>

</body>
</html>
