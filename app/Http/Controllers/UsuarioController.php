<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        if ($request->session()->has('usuario_id')) {
            return redirect('/principal');
        }

        return view('login');
    }

    public function autenticar(Request $request)
    {
        $dados = $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ], [
            'email.required' => 'Informe o e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'senha.required' => 'Informe a senha.',
        ]);

        $usuario = User::where('email', $dados['email'])->first();

        if (!$usuario || !$this->senhaConfere($dados['senha'], $usuario)) {
            return back()->withInput($request->only('email'))
                ->with('erro', 'E-mail ou senha inválidos.');
        }

        $request->session()->regenerate();
        $request->session()->put('usuario_id', $usuario->id);
        $request->session()->put('usuario_nome', $usuario->nome);

        return redirect('/principal');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('sucesso', 'Você saiu do sistema.');
    }

    private function senhaConfere(string $senha, User $usuario): bool
    {
        if (str_starts_with($usuario->senha, '$2y$')) {
            return Hash::check($senha, $usuario->senha);
        }

        if (hash_equals($usuario->senha, hash('sha256', $senha))) {
            $usuario->update(['senha' => Hash::make($senha)]);
            return true;
        }

        return false;
    }
}
