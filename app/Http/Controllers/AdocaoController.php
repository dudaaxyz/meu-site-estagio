<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoe;

class AdocaoController extends Controller
{
    public function create()
    {
        $adotados = Adoe::where('status', 'aprovado')
            ->pluck('nome_animal')
            ->toArray();

        return view('adocao', compact('adotados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_animal' => 'required',
            'tipo'        => 'required',
            'raca'        => 'required',
            'idade'       => 'required',
            'sexo'        => 'required',
            'telefone'    => 'required',
            'termo_aceito'=> 'accepted',
            'assinatura'  => 'required|min:3',
        ]);

        Adoe::create([
            'nome_animal'   => $request->nome_animal,
            'tipo'          => $request->tipo,
            'raca'          => $request->raca,
            'idade'         => $request->idade,
            'sexo'          => $request->sexo,

            // 🔥 pega direto do login
            'nome_usuario'  => session('usuario_nome'),
            'email_usuario' => session('usuario_email'),

            'telefone'      => $request->telefone,
            'termo_aceito'  => true,
            'assinatura'    => $request->assinatura,
            'status'        => 'pendente',
        ]);

        return redirect('/meus-pedidos')->with('success', 'Pedido enviado! Status: PENDENTE 🐾');
    }

    public function meusPedidos()
    {
        $email = session('usuario_email');

        $pedidos = Adoe::where('email_usuario', $email)
            ->orderByDesc('created_at')
            ->get();

        return view('meus_pedidos', compact('pedidos'));
    }
}
