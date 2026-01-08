<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;

class AnimalController extends Controller
{
    // Mostrar todos os animais disponíveis
    public function index()
    {
        $animais = Animal::where('status', 'disponível')->get();
        return view('adocao', compact('animais'));
    }

    // Página para cadastro de novo animal (somente admin, futuramente)
    public function create()
    {
        return view('cadastro_animal');
    }

    // Salvar animal no banco
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'especie' => 'required',
            'idade' => 'nullable|integer',
            'foto' => 'nullable|image',
        ]);

        $dados = $request->all();

        // Se tiver foto, salvar
        if ($request->hasFile('foto')) {
            $dados['foto'] = $request->file('foto')->store('animais', 'public');
        }

        Animal::create($dados);

        return redirect('/adocao')->with('success', 'Animal cadastrado com sucesso!');
    }
}
