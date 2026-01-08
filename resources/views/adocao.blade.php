@extends('layouts.main')

@section('title', 'Adoção')

@section('content')
<h1 class="mb-4 text-center text-info">Animais disponíveis para adoção 🐾</h1>

<!-- Filtro de Tipo -->
<div class="text-center mb-4">
    <button class="btn btn-info me-2 filter-btn" data-tipo="Todos">Todos</button>
    <button class="btn btn-info me-2 filter-btn" data-tipo="Cachorro">Cachorro 🐶</button>
    <button class="btn btn-info filter-btn" data-tipo="Gato">Gato 🐱</button>
</div>

<div class="row g-4" id="animais-container">
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

    @foreach($animais as $animal)
        <div class="col-md-4 col-sm-6 animal-card" data-tipo="{{ $animal['tipo'] }}">
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
                    <a href="#" class="btn btn-info mt-auto w-100">Quero Adotar!</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Script para filtrar os animais -->
<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const tipo = btn.getAttribute('data-tipo');
        document.querySelectorAll('.animal-card').forEach(card => {
            if(tipo === 'Todos' || card.getAttribute('data-tipo') === tipo){
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
