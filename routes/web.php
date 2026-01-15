<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\AdocaoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAdocaoController;

/* ROTAS PÚBLICAS */
Route::get('/', fn() => view('home'))->name('home');

Route::get('/cadastro', fn() => view('auth'))->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastro'])->name('cadastro.post');
Route::get('/login', fn() => view('login'))->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/sair', [AuthController::class, 'logout'])->name('logout');

/* ROTAS PROTEGIDAS (PRECISA ESTAR LOGADO) */
Route::middleware('usuario')->group(function () {

    // ADOÇÃO - LISTA
    Route::get('/adocao', [AdocaoController::class, 'index'])->name('adocao.index');

    // ADOÇÃO - TELA DE CONFIRMAÇÃO (outra página)
    Route::get('/adocao/confirmar/{id}', [AdocaoController::class, 'confirmar'])->name('adocao.confirmar');

    // ADOÇÃO - ENVIAR PEDIDO (POST)
    Route::post('/adocao/confirmar', [AdocaoController::class, 'store'])->name('adocao.store');

    // Meus pedidos (usuário)
    Route::get('/meus-pedidos', [AdocaoController::class, 'meusPedidos'])->name('meus.pedidos');

    // DOAÇÃO
    Route::get('/doacao', [DoacaoController::class, 'create'])->name('doacao.create');
    Route::post('/doacao', [DoacaoController::class, 'store'])->name('doacao.store');
});


/* ROTAS ADMIN (somente email admin) */
Route::middleware('admin')->prefix('admin')->group(function () {

    // Painel de adoções
    Route::get('/adocoes', [AdminAdocaoController::class, 'index'])->name('admin.adocoes');

    // Aprovar / Rejeitar
    Route::post('/adocoes/{id}/aprovar', [AdminAdocaoController::class, 'aprovar'])->name('admin.adocoes.aprovar');
    Route::post('/adocoes/{id}/rejeitar', [AdminAdocaoController::class, 'rejeitar'])->name('admin.adocoes.rejeitar');
});
