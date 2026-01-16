<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\AdocaoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAdocaoController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\PerfilController;

/* ROTAS PÚBLICAS */
Route::get('/', fn() => view('home'))->name('home');

Route::get('/cadastro', fn() => view('auth'))->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastro'])->name('cadastro.post');

Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/sair', [AuthController::class, 'logout'])->name('logout');


/* PÁGINA PÚBLICA DE DETALHES DO ANIMAL (tipo Adotar) */
Route::get('/animais/{id}', [AnimalController::class, 'show'])->name('animais.show');


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

    // MEUS ANIMAIS (usuário cadastra e edita os próprios anúncios)
    Route::get('/meus-animais', [AnimalController::class, 'meusAnimais'])->name('animais.meus');
    Route::get('/meus-animais/novo', [AnimalController::class, 'create'])->name('animais.create');
    Route::post('/meus-animais', [AnimalController::class, 'store'])->name('animais.store');
    Route::get('/meus-animais/{id}/editar', [AnimalController::class, 'edit'])->name('animais.edit');
    Route::put('/meus-animais/{id}', [AnimalController::class, 'update'])->name('animais.update');

    // DOAÇÃO
    Route::get('/doacao', [DoacaoController::class, 'create'])->name('doacao.create');
    Route::post('/doacao', [DoacaoController::class, 'store'])->name('doacao.store');

    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil.show');
Route::get('/perfil/editar', [PerfilController::class, 'edit'])->name('perfil.edit');
Route::put('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

});


/* ROTAS ADMIN (somente email admin) */
Route::middleware('admin')->prefix('admin')->group(function () {

    // Painel de adoções
    Route::get('/adocoes', [AdminAdocaoController::class, 'index'])->name('admin.adocoes');

    // Aprovar / Rejeitar
    Route::post('/adocoes/{id}/aprovar', [AdminAdocaoController::class, 'aprovar'])->name('admin.adocoes.aprovar');
    Route::post('/adocoes/{id}/rejeitar', [AdminAdocaoController::class, 'rejeitar'])->name('admin.adocoes.rejeitar');



});

