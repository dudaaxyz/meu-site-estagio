@extends('layouts.main')

@section('title', 'Adoção')

@section('content')
<h1 class="mb-4 text-center text-info">Animais disponíveis para adoção 🐾</h1>

<div class="row g-4">
    @php
        $animais = [
            ['nome' => 'Rex', 'tipo' => 'Cachorro', 'raca' => 'Vira-lata', 'idade' => '2 anos', 'imagem' => '/img/rex.jpg', 'sexo' => 'Macho'],
            ['nome' => 'Mimi', 'tipo' => 'Gato', 'raca' => 'Siamês', 'idade' => '1 ano', 'imagem' => '/img/mimi.jpg', 'sexo' => 'Fêmea'],
            ['nome' => 'Bolt', 'tipo' => 'Cachorro', 'raca' => 'Labrador', 'idade' => '3 anos', 'imagem' => '/img/bolt.jpg', 'sexo' => 'Macho'],
            ['nome' => 'Luna', 'tipo' => 'Cachorro', 'raca' => 'SRD', 'idade' => '4 meses', 'imagem' => '/img/luna.jpg', 'sexo' => 'Fêmea'],
            ['nome' => 'Amora', 'tipo' => 'Gato', 'raca' => 'SRD', 'idade' => '9 meses', 'imagem' => '/img/amora.jpg', 'sexo' => 'Fêmea'],
            ['nome' => 'Bob', 'tipo' => 'Gato', 'raca' => 'SRD', 'idade' => '4 meses', 'imagem' => '/img/bob.jpg', 'sexo' => 'Fêmea'],
            ['nome' => 'Negão', 'tipo' => 'Cachorro', 'raca' => 'SRD', 'idade' => '5 meses', 'imagem' => '/img/negao.jpg', 'sexo' => 'Macho'],
            ['nome' => 'Bela', 'tipo' => 'Cachorro', 'raca' => 'SRD', 'idade' => '2 anos', 'imagem' => '/img/bela.jpg', 'sexo' => 'Fêmea'],
            ['nome' => 'Chico', 'tipo' => 'Cachorro', 'raca' => 'SRD', 'idade' => '1 ano', 'imagem' => '/img/chico.jpg', 'sexo' => 'Macho'],
            ['nome' => 'Huck', 'tipo' => 'Cachorro', 'raca' => 'SRD', 'idade' => '11 meses', 'imagem' => '/img/huck.jpg', 'sexo' => 'Macho'],
        ];
    @endphp

    @foreach($animais as $index => $animal)
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm">
                <img src="{{ $animal['imagem'] }}" class="card-img-top" alt="{{ $animal['nome'] }}" style="height: 250px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $animal['nome'] }}</h5>
                    <p class="card-text mb-3">
                        Tipo: {{ $animal['tipo'] }}<br>
                        Raça: {{ $animal['raca'] }}<br>
                        Idade: {{ $animal['idade'] }}<br>
                        Sexo: {{ $animal['sexo'] }}
                    </p>
                    <!-- Botão para abrir modal -->
                    <button class="btn btn-info mt-auto w-100" data-bs-toggle="modal" data-bs-target="#adotarModal{{ $index }}">
                        Quero Adotar!
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="adotarModal{{ $index }}" tabindex="-1" aria-labelledby="adotarModalLabel{{ $index }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="adotarModalLabel{{ $index }}">Adotar {{ $animal['nome'] }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/adocao/compromisso" method="POST">
                            @csrf
                            <input type="hidden" name="animal" value="{{ $animal['nome'] }}">

                            <div class="mb-3">
                                <label for="nome{{ $index }}" class="form-label">Seu Nome</label>
                                <input type="text" class="form-control" id="nome{{ $index }}" name="nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="email{{ $index }}" class="form-label">Seu Email</label>
                                <input type="email" class="form-control" id="email{{ $index }}" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="data{{ $index }}" class="form-label">Dia para buscar {{ $animal['nome'] }}</label>
                                <input type="date" class="form-control" id="data{{ $index }}" name="data" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Confirmar Adoção</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
