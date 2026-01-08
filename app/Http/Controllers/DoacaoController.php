<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doacao;

class DoacaoController extends Controller
{
    // MOSTRA A PÁGINA DE DOAÇÃO
    public function create()
    {
        return view('doacao');
    }

    // SALVA A DOAÇÃO NO BANCO
    public function store(Request $request)
    {
        Doacao::create([
            'nome'  => $request->nome,
            'email' => $request->email,
            'valor' => $request->valor,
        ]);

        return redirect('/doacao')->with('success', 'Doação realizada com sucesso ❤️');
    }
}
