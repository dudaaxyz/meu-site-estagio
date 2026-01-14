<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UsuarioLogado
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('usuario_logado') || session('usuario_logado') !== true) {
            return redirect('/login')->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        return $next($request);
    }
}
