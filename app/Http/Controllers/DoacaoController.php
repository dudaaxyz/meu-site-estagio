<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoacaoController extends Controller
{
    public function index()
    {
        return view('doacao'); // apenas mostra o formulário
    }

    public function store(Request $request)
    {
        // Validação simples
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'valor' => 'required|numeric|min:1'
        ]);

        // Salvar no banco
        DB::table('doacoes')->insert([
            'nome' => $request->nome,
            'email' => $request->email,
            'valor' => $request->valor,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/doacao')->with('success', 'Doação realizada com sucesso! ❤️');
    }
}
