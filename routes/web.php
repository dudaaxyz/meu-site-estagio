<?php

use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\AdocaoController;

Route::get('/', function () {
    return view('home');
});

Route::get('/cadastro', function () {
    return view('auth');
});

Route::get('/login', function () {
    return view('login');
});

/* ADOÇÃO */
Route::get('/adocao', [AdocaoController::class, 'index']);

/* DOAÇÃO */
Route::get('/doacao', [DoacaoController::class, 'create']);
Route::post('/doacao', [DoacaoController::class, 'store']);

/* ADMIN */
Route::get('/admin/doacoes', [DoacaoController::class, 'index']);
