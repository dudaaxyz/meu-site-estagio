<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class PerfilController extends Controller
{
    public function show()
    {
        $userId = session('usuario_id');
        $usuario = Usuario::findOrFail($userId);

        return view('perfil.show', compact('usuario'));
    }

    public function edit()
    {
        $userId = session('usuario_id');
        $usuario = Usuario::findOrFail($userId);

        return view('perfil.edit', compact('usuario'));
    }

    public function update(Request $request)
    {
        $userId = session('usuario_id');
        $usuario = Usuario::findOrFail($userId);

        $request->validate([
            'nome' => 'required|min:2|max:100',
            'email' => 'required|email|max:150',
            'telefone' => 'nullable|max:30',
        ]);

        // impede trocar email para um que já existe em outro usuário
        $emailJaExiste = Usuario::where('email', $request->email)
            ->where('id', '!=', $userId)
            ->exists();

        if ($emailJaExiste) {
            return back()->withErrors(['email' => 'Este e-mail já está em uso.'])->withInput();
        }

        $usuario->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
        ]);

        // atualiza sessão para o "Olá, nome" mudar na hora
        session([
            'usuario_nome' => $usuario->nome,
            'usuario_email' => $usuario->email,
        ]);

        return redirect()->route('perfil.show')->with('success', 'Perfil atualizado com sucesso ✅');
    }
}
