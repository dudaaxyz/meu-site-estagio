<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function show($id)
    {
        $animal = Animal::with('dono')->findOrFail($id);
        return view('animais.show', compact('animal'));
    }

    public function meusAnimais()
    {
        $userId = session('usuario_id');

        $animais = Animal::where('user_id', $userId)
            ->orderByDesc('id')
            ->get();

        return view('animais.meus', compact('animais'));
    }

    public function create()
    {
        return view('animais.create');
    }

    public function store(Request $request)
    {
        $userId = session('usuario_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado.');
        }

        $request->validate([
            'nome' => 'required|min:2',
            'especie' => 'required|in:Cachorro,Gato',
            'raca' => 'nullable|string|max:100',
            'idade' => 'nullable|string|max:50', // ✅ texto livre
            'sexo' => 'nullable|in:Macho,Fêmea',
            'foto' => 'required|image|max:2048',
            'descricao' => 'nullable|string|max:1000',
            'cidade' => 'nullable|string|max:100',
            'uf' => 'nullable|string|size:2',
            'contato_whatsapp' => 'nullable|string|max:30',
        ]);

        $dados = $request->except('foto');

        $dados['user_id'] = $userId;
        $dados['status'] = 'disponível';

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('animais', 'public');
            $dados['foto'] = '/storage/' . $path;
        }

        Animal::create($dados);

        return redirect()->route('animais.meus')
            ->with('success', 'Animal cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $userId = session('usuario_id');
        $animal = Animal::findOrFail($id);

        if ((int)$animal->user_id !== (int)$userId) {
            abort(403);
        }

        return view('animais.edit', compact('animal'));
    }

    public function update(Request $request, $id)
    {
        $userId = session('usuario_id');
        $animal = Animal::findOrFail($id);

        if ((int)$animal->user_id !== (int)$userId) {
            abort(403);
        }

        $request->validate([
            'nome' => 'required|min:2',
            'especie' => 'required|in:Cachorro,Gato',
            'raca' => 'nullable|string|max:100',
            'idade' => 'nullable|string|max:50', // ✅ texto livre
            'sexo' => 'nullable|in:Macho,Fêmea',
            'foto' => 'nullable|image|max:2048',
            'descricao' => 'nullable|string|max:1000',
            'cidade' => 'nullable|string|max:100',
            'uf' => 'nullable|string|size:2',
            'contato_whatsapp' => 'nullable|string|max:30',
        ]);

        $dados = $request->except('foto');

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('animais', 'public');
            $dados['foto'] = '/storage/' . $path;
        }

        $animal->update($dados);

        return redirect()->route('animais.meus')
            ->with('success', 'Anúncio atualizado ✅');
    }
}
