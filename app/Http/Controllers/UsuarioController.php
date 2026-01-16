<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function store(Request $request)
    {
        // Validar dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6',
            'telefone' => 'nullable|string|max:30',
            'endereco' => 'nullable|string|max:255',
        ]);

        dd($request->all());

        // Criar usuário
        Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => bcrypt($request->senha), // criptografa a senha
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
        ]);

        return redirect('/')->with('success', 'Cadastro realizado com sucesso!');
    }
}
