<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoe;
use App\Models\Animal;

class AdocaoController extends Controller
{
    // LISTA DE ANIMAIS DISPONÍVEIS
    public function index(Request $request)
{
    $especie = $request->especie; // vem do form

    $query = Animal::where('status', 'disponível');

    if ($especie && $especie !== 'Todos') {
        $query->where('especie', $especie);
    }

    $animais = $query->orderBy('id')->get();

    return view('adocao', compact('animais', 'especie'));
}


    // TELA DE CONFIRMAÇÃO
    public function confirmar($id)
    {
        $animal = Animal::findOrFail($id);

        if ($animal->status !== 'disponível') {
            return redirect()->route('adocao.index')
                ->with('error', 'Esse animal não está mais disponível 😢');
        }

        return view('confirmacao', compact('animal'));
    }

    // SALVAR PEDIDO DE ADOÇÃO
    public function store(Request $request)
    {
        $request->validate([
            'animal_id'     => 'required|exists:animais,id',
            'termo_aceito'  => 'accepted',
            'assinatura'    => 'required|min:3',
        ]);

        $userId = session('usuario_id');

        if (!$userId) {
            return redirect()->route('login')
                ->with('error', 'Você precisa estar logado.');
        }

        $animal = Animal::findOrFail($request->animal_id);

        // Se o animal não estiver mais disponível, bloqueia
        if ($animal->status !== 'disponível') {
            return redirect()->route('adocao.index')
                ->with('error', 'Esse animal já não está disponível 😢');
        }

        // Impede pedido duplicado do mesmo usuário
        $jaExiste = Adoe::where('user_id', $userId)
            ->where('animal_id', $animal->id)
            ->whereIn('status', ['pendente', 'aprovado'])
            ->exists();

        if ($jaExiste) {
            return redirect()->route('meus.pedidos')
                ->with('error', 'Você já solicitou esse animal.');
        }

        // Cria o pedido de adoção
        Adoe::create([
            'user_id'     => $userId,
            'animal_id'   => $animal->id,
            'status'      => 'pendente',
            'data_adocao' => now(),
        ]);

       

        return redirect()->route('meus.pedidos')
            ->with('success', 'Pedido enviado! Status: PENDENTE ✅');
    }

    // MEUS PEDIDOS
    public function meusPedidos()
    {
        $userId = session('usuario_id');

        $pedidos = Adoe::with('animal')
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();

        return view('meus_pedidos', compact('pedidos'));
    }
}
