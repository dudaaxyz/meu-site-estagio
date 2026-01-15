<?php

namespace App\Http\Controllers;

use App\Models\Adoe;
use App\Models\Animal;

class AdminAdocaoController extends Controller
{
   public function index()
{
    $adoes = Adoe::with(['usuario', 'animal'])
        ->orderByDesc('created_at')
        ->get();

    return view('admin.adoes', compact('adoes'));
}


    public function aprovar($id)
    {
        $pedido = Adoe::findOrFail($id);

        // 1) aprova o pedido
        $pedido->status = 'aprovado';
        $pedido->decisao_em = now(); // se existir essa coluna na migration
        $pedido->save();

        // 2) marca o animal como adotado (IMPORTANTE pro animal sumir da página)
        $animal = Animal::find($pedido->animal_id);
        if ($animal) {
            $animal->status = 'adotado'; // precisa bater com o CHECK do banco
            $animal->save();
        }

        return back()->with('success', 'Adoção aprovada ✅ Animal marcado como adotado e removido da lista 🐾');
    }

    public function rejeitar($id)
    {
        $pedido = Adoe::findOrFail($id);

        $pedido->status = 'rejeitado';
        $pedido->decisao_em = now(); // se existir essa coluna na migration
        $pedido->save();

        return back()->with('success', 'Adoção rejeitada ❌');
    }
}
