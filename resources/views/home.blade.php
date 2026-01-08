@extends('layouts.main')

@section('title', 'Home')

@section('content')
<!-- Banner -->
<div class="mb-5">
    <img src="/img/banner.jpg" alt="Pet Acolhe Banner" class="img-fluid rounded shadow-sm w-100" style="max-height: 500px; object-fit: cover;">
</div>

<!-- Texto de boas-vindas abaixo do banner -->
<div class="text-center mb-5">
    <h1 class="mb-3 text-info">Bem-vindo ao Pet Acolhe 🐶🐱</h1>
    <p class="lead">Adote, doe e ajude animais a encontrarem um lar.</p>
</div>

<!-- Opcional: Cards chamativos de Adoção e Doação -->
<div class="row text-center">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <h3 class="card-title mb-3">Adotar 🐾</h3>
                <p class="card-text">Veja os animais disponíveis para adoção e encontre seu novo amigo.</p>
                <a href="/adocao" class="btn btn-info mt-auto">Quero Adotar!</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <h3 class="card-title mb-3">Doar ❤️</h3>
                <p class="card-text">Ajude os animais com doações e faça a diferença na vida deles.</p>
                <a href="/doacao" class="btn btn-info mt-auto">Quero Doar!</a>
            </div>
        </div>
    </div>
</div>

@endsection
