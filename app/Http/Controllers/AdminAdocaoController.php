<?php

namespace App\Http\Controllers;

use App\Models\Adoe;

class AdminAdocaoController extends Controller
{
    public function index()
    {
        $pedidos = Adoe::orderByDesc('created_at')->get();
        return view('admin.adoes', compact('pedidos'));
    }

    public function aprovar($id)
    {
        $pedido = Adoe::findOrFail($id);
        $pedido->update([
            'status' => 'aprovado',
            'decisao_em' => now(),
        ]);

        return back()->with('success', 'Adoção aprovada ✅');
    }

    public function rejeitar($id)
    {
        $pedido = Adoe::findOrFail($id);
        $pedido->update([
            'status' => 'rejeitado',
            'decisao_em' => now(),
        ]);

        return back()->with('success', 'Adoção rejeitada ❌');
    }
}
