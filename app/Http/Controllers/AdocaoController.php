<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoe;
use App\Models\Animal;

class AdocaoController extends Controller
{
    public function create()
    {
        // Pega só os animais disponíveis (status com acento)
        $animais = Animal::where('status', 'disponível')
            ->orderBy('id')
            ->get();

        return view('adocao', compact('animais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal_id'     => 'required|exists:animais,id',
            'termo_aceito'  => 'accepted',
            'assinatura'    => 'required|min:3',
        ]);

        // cria o pedido de adoção (pendente)
        $adocao = Adoe::create([
            'user_id'     => session('usuario_id'), // se não tiver isso, me fala que eu ajusto
            'animal_id'   => $request->animal_id,
            'status'      => 'pendente',
            'data_adocao' => now(),
        ]);

        return redirect('/adocao')->with('success', 'Pedido enviado! Status: PENDENTE ✅');
    }

    public function meusPedidos()
    {
        $userId = session('usuario_id');

        $pedidos = Adoe::where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();

        return view('meus_pedidos', compact('pedidos'));
    }
}
