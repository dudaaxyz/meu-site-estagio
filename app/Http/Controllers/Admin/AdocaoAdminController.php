<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoe;

class AdocaoAdminController extends Controller
{
    public function index()
    {
        $pedidos = Adoe::orderByRaw("
            CASE status
                WHEN 'pendente' THEN 1
                WHEN 'aprovado' THEN 2
                WHEN 'rejeitado' THEN 3
                ELSE 4
            END
        ")->orderByDesc('created_at')->get();

        return view('admin.adocoes', compact('pedidos'));
    }

    public function aprovar($id)
    {
        $pedido = Adoe::findOrFail($id);

        $pedido->update([
            'status' => 'aprovado',
            'decisao_em' => now(),
        ]);

        return redirect()->back()->with('success', 'Adoção APROVADA ✅');
    }

    public function rejeitar($id)
    {
        $pedido = Adoe::findOrFail($id);

        $pedido->update([
            'status' => 'rejeitado',
            'decisao_em' => now(),
        ]);

        return redirect()->back()->with('success', 'Adoção REJEITADA ✅');
    }
}
