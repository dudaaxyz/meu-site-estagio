<?php

use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('home');
});

// Página de Adoção
Route::get('/adocao', function () {
    // Simulando animais disponíveis
    $animais = [
        ['nome' => 'Rex', 'especie' => 'Cachorro', 'idade' => '2 anos'],
        ['nome' => 'Mimi', 'especie' => 'Gato', 'idade' => '1 ano'],
    ];
    return view('adocao', ['animais' => $animais]);
});

// Página de Doação
Route::get('/doacao', function () {
    return view('doacao');
});
use App\Http\Controllers\DoacaoController;

Route::get('/doacao', [DoacaoController::class, 'index']);
Route::post('/doacao', [DoacaoController::class, 'store']);

use App\Http\Controllers\AdocaoController;

Route::post('/adocao', [AdocaoController::class, 'store'])->name('adocao.store');



Route::post('/doacao', function (\Illuminate\Http\Request $request) {
    $valor = $request->input('valor');
    // Aqui você pode salvar no banco ou apenas mostrar a mensagem
    return redirect('/doacao')->with('success', "Obrigado pela sua doação de R$ $valor!");
});
