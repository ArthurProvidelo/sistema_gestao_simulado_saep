<!DOCTYPE html>
<html>
<head>
    <title>Editar agendamento</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Editar agendamento</h1>

    <a href="/agendamentos/listar">Voltar</a>

    @if(session('erro'))
        <p>{{ session('erro') }}</p>
    @endif

    @foreach($errors->all() as $erro)
        <p>{{ $erro }}</p>
    @endforeach

    <form action="/agendamentos/{{ $agendamento->id }}" method="POST">
        @csrf
        @method('PUT')

        <label>Data:</label>
        <input type="date" name="data" value="{{ old('data', $agendamento->data) }}">
        <br><br>

        <label>Hora:</label>
        <input type="time" name="hora" value="{{ old('hora', substr($agendamento->hora, 0, 5)) }}">
        <br><br>

        <label>Descrição:</label>
        <input type="text" name="descricao" value="{{ old('descricao', $agendamento->descricao) }}">
        <br><br>

        <label>Sala:</label>
        <select name="sala_id">
            <option value="">Selecione</option>
            @foreach($salas as $sala)
                <option value="{{ $sala->id }}" @selected(old('sala_id', $agendamento->sala_id) == $sala->id)>
                    {{ $sala->num_sala }} - {{ $sala->bloco }} ({{ $sala->empresa->nome }})
                </option>
            @endforeach
        </select>
        <br><br>

        <button type="submit">Atualizar</button>
    </form>

</body>
</html>
