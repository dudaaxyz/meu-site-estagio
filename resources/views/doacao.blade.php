@extends('layouts.main')

@section('title', 'Doação')

@section('content')
<div class="container">

    <h1 class="mb-4 text-info">Faça sua Doação ❤️</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="alert alert-info text-center">
        Você está logado como <strong>{{ session('usuario_nome') }}</strong><br>
        {{ session('usuario_email') }}
    </div>

    <!-- Formulário de Doação -->
    <form action="{{ route('doacao.store') }}" method="POST" class="mb-5 mx-auto" style="max-width: 400px;">
        @csrf

        <div class="mb-3">
            <label class="form-label">Valor da Doação (R$)</label>
            <input type="number" name="valor" class="form-control" min="1" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-info w-100">Doar ❤️</button>
    </form>

    <hr>

    <!-- Animais ajudados -->
    <h2 class="mb-4 text-info">Alguns dos animais que você está ajudando 🐾</h2>

    <div class="row">
        @php
            $animais = [
                ['nome' => 'Rex', 'tipo' => 'Cachorro', 'raca' => 'Vira-lata', 'idade' => '2 anos', 'imagem' => '/img/rex.jpg', 'sexo' => 'Macho'],
                ['nome' => 'Mimi', 'tipo' => 'Gato', 'raca' => 'Siamês', 'idade' => '1 ano', 'imagem' => '/img/mimi.jpg', 'sexo' => 'Fêmea'],
                ['nome' => 'Bolt', 'tipo' => 'Cachorro', 'raca' => 'Labrador', 'idade' => '3 anos', 'imagem' => '/img/bolt.jpg', 'sexo' => 'Macho'],
                ['nome' => 'Luna', 'tipo' => 'Cachorro', 'raca' => 'SRD', 'idade' => '4 meses', 'imagem' => '/img/luna.jpg', 'sexo' => 'Fêmea'],
            ];
        @endphp

        @foreach($animais as $animal)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ $animal['imagem'] }}" class="card-img-top" alt="{{ $animal['nome'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $animal['nome'] }}</h5>
                        <p class="card-text">
                            Tipo: {{ $animal['tipo'] }}<br>
                            Raça: {{ $animal['raca'] }}<br>
                            Idade: {{ $animal['idade'] }}<br>
                            Sexo: {{ $animal['sexo'] }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
