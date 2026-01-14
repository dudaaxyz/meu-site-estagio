<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doacao;

class DoacaoController extends Controller
{
    public function create()
    {
        return view('doacao');
    }

    public function store(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric|min:1',
        ]);

        Doacao::create([
            'nome'  => session('usuario_nome'),
            'email' => session('usuario_email'),
            'valor' => $request->valor,
        ]);

        return redirect('/')->with('success', 'Doação realizada com sucesso ❤️');
    }
}
