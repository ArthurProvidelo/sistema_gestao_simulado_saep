<!DOCTYPE html>
<html>
<head>
    <title>Agendamentos</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Agendamentos</h1>

    <a href="/principal">Voltar</a> |
    <a href="/agendamentos/create">Novo agendamento</a>

    <br><br>

    @if(session('sucesso'))
        <p>{{ session('sucesso') }}</p>
    @endif

    @if(session('erro'))
        <p>{{ session('erro') }}</p>
    @endif

    <table border="1" cellpadding="5">
        <tr>
            <th>Data</th>
            <th>Hora</th>
            <th>Descrição</th>
            <th>Sala</th>
            <th>Bloco</th>
            <th>Empresa</th>
            <th>CNPJ</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>

        @forelse($agendamentos as $agendamento)
            <tr>
                <td>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
                <td>{{ substr($agendamento->hora, 0, 5) }}</td>
                <td>{{ $agendamento->descricao }}</td>
                <td>{{ $agendamento->sala->num_sala }}</td>
                <td>{{ $agendamento->sala->bloco }}</td>
                <td>{{ $agendamento->sala->empresa->nome }}</td>
                <td>{{ $agendamento->sala->empresa->cnpj }}</td>
                <td>{{ $agendamento->sala->empresa->telefone }}</td>
                <td>{{ $agendamento->sala->empresa->email }}</td>
                <td>
                    <a href="/agendamentos/{{ $agendamento->id }}/edit">Editar</a>
                    <form action="/agendamentos/{{ $agendamento->id }}" method="POST" style="display:inline"
                          onsubmit="return confirm('Excluir este agendamento?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10">Nenhum agendamento cadastrado.</td>
            </tr>
        @endforelse
    </table>

</body>
</html>
