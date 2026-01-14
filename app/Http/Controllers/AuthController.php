<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function cadastro(Request $request)
    {
        $request->validate([
            'nome'  => 'required|min:2',
            'email' => 'required|email',
            'senha' => 'required|min:4',
        ]);

        // Se já existe, bloqueia e manda pro login
        if (Usuario::where('email', $request->email)->exists()) {
            return redirect('/login')->with('error', 'Esse email já está cadastrado. Faça login.');
        }

        Usuario::create([
            'nome'  => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        return redirect('/login')->with('success', 'Cadastro feito! Agora faça login ✅');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->senha, $usuario->senha)) {
            return redirect('/login')->with('error', 'Email ou senha inválidos.');
        }

        // ✅ Sessão do login
        session([
            'usuario_logado' => true,
            'usuario_nome'   => $usuario->nome,
            'usuario_email'  => $usuario->email,
        ]);

        return redirect('/')->with('success', 'Login feito com sucesso ✅');
    }

    public function logout()
    {
        session()->forget(['usuario_logado', 'usuario_nome', 'usuario_email']);
        session()->flush();

        return redirect('/')->with('success', 'Você saiu da conta.');
    }
}
