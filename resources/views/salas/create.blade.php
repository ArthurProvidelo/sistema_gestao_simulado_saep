<!DOCTYPE html>
<html>
<head>
    <title>Nova sala</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Nova sala</h1>

    <a href="/salas/listar">Voltar</a>

    @foreach($errors->all() as $erro)
        <p>{{ $erro }}</p>
    @endforeach

    <form action="/salas" method="POST">
        @csrf

        <label>Número da sala:</label>
        <input type="text" name="num_sala" value="{{ old('num_sala') }}">
        <br><br>

        <label>Bloco:</label>
        <input type="text" name="bloco" value="{{ old('bloco') }}">
        <br><br>

        <label>Empresa:</label>
        <select name="empresa_id">
            <option value="">Selecione</option>
            @foreach($empresas as $empresa)
                <option value="{{ $empresa->id }}" @selected(old('empresa_id') == $empresa->id)>
                    {{ $empresa->nome }}
                </option>
            @endforeach
        </select>
        <br><br>

        <button type="submit">Salvar</button>
    </form>

</body>
</html>
