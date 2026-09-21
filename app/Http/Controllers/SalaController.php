<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Sala;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function listar()
    {
        $salas = Sala::with('empresa')->orderBy('bloco')->orderBy('num_sala')->get();

        return view('salas.listar', compact('salas'));
    }

    public function create()
    {
        $empresas = Empresa::orderBy('nome')->get();

        return view('salas.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        Sala::create($this->validar($request));

        return redirect('/salas/listar')->with('sucesso', 'Sala cadastrada.');
    }

    public function edit($id)
    {
        $sala = Sala::findOrFail($id);
        $empresas = Empresa::orderBy('nome')->get();

        return view('salas.edit', compact('sala', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        Sala::findOrFail($id)->update($this->validar($request));

        return redirect('/salas/listar')->with('sucesso', 'Sala atualizada.');
    }

    public function destroy($id)
    {
        try {
            Sala::findOrFail($id)->delete();
        } catch (QueryException $e) {
            return redirect('/salas/listar')
                ->with('erro', 'Não é possível excluir: a sala possui agendamentos.');
        }

        return redirect('/salas/listar')->with('sucesso', 'Sala excluída.');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'num_sala' => 'required|max:100',
            'bloco' => 'required|max:50',
            'empresa_id' => 'required|exists:empresas,id',
        ], [
            'empresa_id.required' => 'Associe a sala a uma empresa.',
            'empresa_id.exists' => 'Empresa inválida.',
        ]);
    }
}
