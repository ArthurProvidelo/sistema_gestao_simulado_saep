<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Sala;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function listar()
    {
        $agendamentos = Agendamento::with('sala.empresa')
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        return view('agendamento.listar', compact('agendamentos'));
    }

    public function create()
    {
        $salas = Sala::with('empresa')->orderBy('bloco')->orderBy('num_sala')->get();

        return view('agendamento.create', compact('salas'));
    }

    public function store(Request $request)
    {
        $dados = $this->validar($request);

        if ($this->haConflito($dados)) {
            return back()->withInput()->with('erro', 'Já existe agendamento para esta sala nesta data e horário.');
        }

        Agendamento::create($dados);

        return redirect('/agendamentos/listar')->with('sucesso', 'Agendamento cadastrado.');
    }

    public function edit($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $salas = Sala::with('empresa')->orderBy('bloco')->orderBy('num_sala')->get();

        return view('agendamento.edit', compact('agendamento', 'salas'));
    }

    public function update(Request $request, $id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $dados = $this->validar($request);

        if ($this->haConflito($dados, $agendamento->id)) {
            return back()->withInput()->with('erro', 'Já existe agendamento para esta sala nesta data e horário.');
        }

        $agendamento->update($dados);

        return redirect('/agendamentos/listar')->with('sucesso', 'Agendamento atualizado.');
    }

    public function destroy($id)
    {
        Agendamento::findOrFail($id)->delete();

        return redirect('/agendamentos/listar')->with('sucesso', 'Agendamento excluído.');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'descricao' => 'nullable|max:255',
            'sala_id' => 'required|exists:salas,id',
        ]);
    }

    // Evita dois agendamentos na mesma sala, data e hora.
    private function haConflito(array $dados, $ignorarId = null): bool
    {
        return Agendamento::where('sala_id', $dados['sala_id'])
            ->where('data', $dados['data'])
            ->where('hora', $dados['hora'])
            ->when($ignorarId, fn ($q) => $q->where('id', '!=', $ignorarId))
            ->exists();
    }
}
