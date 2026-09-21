<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function listar(Request $request)
    {
        $busca = trim((string) $request->query('busca', ''));
        $empresas = Empresa::orderBy('nome')->get();

        if ($busca !== '') {
            $empresas = $empresas->filter(function ($e) use ($busca) {
                foreach ([$e->nome, $e->cnpj, $e->telefone, $e->email] as $campo) {
                    if (mb_stripos((string) $campo, $busca) !== false) {
                        return true;
                    }
                }
                return false;
            });
        }

        return view('empresas.listar', compact('empresas', 'busca'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        Empresa::create($this->validar($request));

        return redirect('/empresas/listar')->with('sucesso', 'Empresa cadastrada.');
    }

    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);

        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, $id)
    {
        Empresa::findOrFail($id)->update($this->validar($request));

        return redirect('/empresas/listar')->with('sucesso', 'Empresa atualizada.');
    }

    public function destroy($id)
    {
        try {
            Empresa::findOrFail($id)->delete();
        } catch (QueryException $e) {
            return redirect('/empresas/listar')
                ->with('erro', 'Não é possível excluir: a empresa possui salas vinculadas.');
        }

        return redirect('/empresas/listar')->with('sucesso', 'Empresa excluída.');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'nome' => 'required|max:100',
            'cnpj' => 'required|max:18',
            'telefone' => 'nullable|max:20',
            'email' => 'nullable|email|max:100',
        ]);
    }
}
