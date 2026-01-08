<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adoe;

class AdocaoController extends Controller
{
    public function store(Request $request)
    {
        Adoe::create($request->all());
        return redirect('/adocao')->with('success', 'Adoção registrada com sucesso! ❤️');
    }
}
