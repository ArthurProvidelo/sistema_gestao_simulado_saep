<!DOCTYPE html>
<html>
<head>
    <title>Novo agendamento</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Novo agendamento</h1>

    <a href="/agendamentos/listar">Voltar</a>

    @if(session('erro'))
        <p>{{ session('erro') }}</p>
    @endif

    @foreach($errors->all() as $erro)
        <p>{{ $erro }}</p>
    @endforeach

    <form action="/agendamentos" method="POST">
        @csrf

        <label>Data:</label>
        <input type="date" name="data" value="{{ old('data') }}">
        <br><br>

        <label>Hora:</label>
        <input type="time" name="hora" value="{{ old('hora') }}">
        <br><br>

        <label>Descrição:</label>
        <input type="text" name="descricao" value="{{ old('descricao') }}">
        <br><br>

        <label>Sala:</label>
        <select name="sala_id">
            <option value="">Selecione</option>
            @foreach($salas as $sala)
                <option value="{{ $sala->id }}" @selected(old('sala_id') == $sala->id)>
                    {{ $sala->num_sala }} - {{ $sala->bloco }} ({{ $sala->empresa->nome }})
                </option>
            @endforeach
        </select>
        <br><br>

        <button type="submit">Salvar</button>
    </form>

</body>
</html>
