<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('usuario_logado')) {
            return redirect('/login')->with('error', 'Faça login.');
        }

        // Email do administrador
        $adminEmail = 'mrdrdcardosoferreira@gmail.com';

        if (session('usuario_email') !== $adminEmail) {
            return redirect('/')->with('error', 'Acesso negado.');
        }

        return $next($request);
    }
}
