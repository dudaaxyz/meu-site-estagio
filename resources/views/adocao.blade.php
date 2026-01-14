@extends('layouts.main')

@section('title', 'Adoção')

@section('content')
<div class="container py-4">

    <h1 class="mb-4 text-center text-info">Animais disponíveis para adoção 🐾</h1>

    <div class="text-center mb-4">
        <button type="button" class="btn btn-info me-2 filter-btn" data-tipo="Todos">Todos</button>
        <button type="button" class="btn btn-info me-2 filter-btn" data-tipo="Cachorro">Cachorro 🐶</button>
        <button type="button" class="btn btn-info filter-btn" data-tipo="Gato">Gato 🐱</button>
    </div>

    @php
        // se não vier do controller, evita erro
        $adotados = $adotados ?? [];

        $animais = [
            ['nome'=>'Rex','tipo'=>'Cachorro','raca'=>'Vira-lata','idade'=>'2 anos','sexo'=>'Macho','imagem'=>'/img/rex.jpg'],
            ['nome'=>'Mimi','tipo'=>'Gato','raca'=>'Siamês','idade'=>'1 ano','sexo'=>'Fêmea','imagem'=>'/img/mimi.jpg'],
            ['nome'=>'Bolt','tipo'=>'Cachorro','raca'=>'Labrador','idade'=>'3 anos','sexo'=>'Macho','imagem'=>'/img/bolt.jpg'],
            ['nome'=>'Luna','tipo'=>'Cachorro','raca'=>'SRD','idade'=>'4 meses','sexo'=>'Fêmea','imagem'=>'/img/luna.jpg'],
            ['nome'=>'Amora','tipo'=>'Gato','raca'=>'SRD','idade'=>'9 meses','sexo'=>'Fêmea','imagem'=>'/img/amora.jpg'],
            ['nome'=>'Bob','tipo'=>'Gato','raca'=>'SRD','idade'=>'4 meses','sexo'=>'Fêmea','imagem'=>'/img/bob.jpg'],
            ['nome'=>'Negão','tipo'=>'Cachorro','raca'=>'SRD','idade'=>'5 meses','sexo'=>'Macho','imagem'=>'/img/negao.jpg'],
            ['nome'=>'Bela','tipo'=>'Cachorro','raca'=>'SRD','idade'=>'2 anos','sexo'=>'Fêmea','imagem'=>'/img/bela.jpg'],
            ['nome'=>'Chico','tipo'=>'Cachorro','raca'=>'SRD','idade'=>'1 ano','sexo'=>'Macho','imagem'=>'/img/chico.jpg'],
            ['nome'=>'Huck','tipo'=>'Cachorro','raca'=>'SRD','idade'=>'11 meses','sexo'=>'Macho','imagem'=>'/img/huck.jpg'],
        ];
    @endphp

    <div class="row g-4" id="animais-container">
        @foreach($animais as $animal)
            @if(!in_array($animal['nome'], $adotados))
                <div class="col-md-4 col-sm-6 animal-card" data-tipo="{{ $animal['tipo'] }}">
                    <div class="card h-100 shadow-sm">

                        <img src="{{ $animal['imagem'] }}"
                             class="card-img-top"
                             alt="{{ $animal['nome'] }}"
                             style="height:240px; object-fit:cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $animal['nome'] }}</h5>

                            <p class="card-text">
                                Tipo: {{ $animal['tipo'] }}<br>
                                Raça: {{ $animal['raca'] }}<br>
                                Idade: {{ $animal['idade'] }}<br>
                                Sexo: {{ $animal['sexo'] }}
                            </p>

                            <button type="button"
                                    class="btn btn-info mt-auto w-100 btn-adotar"
                                    data-nome="{{ $animal['nome'] }}"
                                    data-tipo="{{ $animal['tipo'] }}"
                                    data-raca="{{ $animal['raca'] }}"
                                    data-idade="{{ $animal['idade'] }}"
                                    data-sexo="{{ $animal['sexo'] }}">
                                Quero Adotar
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <hr class="my-4">

    <h3 id="form-adocao" class="text-info text-center mb-3">Pedido de adoção 🐾</h3>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Corrija os erros abaixo:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('adocao.store') }}" class="mx-auto" style="max-width: 700px;">
        @csrf

        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <input type="text" name="nome_animal" id="nome_animal" class="form-control" placeholder="Animal" readonly required>
            </div>
            <div class="col-md-6">
                <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Tipo" readonly required>
            </div>
            <div class="col-md-6">
                <input type="text" name="raca" id="raca" class="form-control" placeholder="Raça" readonly required>
            </div>
            <div class="col-md-6">
                <input type="text" name="idade" id="idade" class="form-control" placeholder="Idade" readonly required>
            </div>
            <div class="col-md-6">
                <input type="text" name="sexo" id="sexo" class="form-control" placeholder="Sexo" readonly required>
            </div>
        </div>

        <input type="text" name="telefone" class="form-control mb-2" placeholder="Telefone" required>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="termo_aceito" id="termo_aceito" required>
            <label class="form-check-label" for="termo_aceito">Aceito o termo</label>
        </div>

        <input type="text" name="assinatura" class="form-control mb-3" placeholder="Assinatura" required>

        <button type="submit" class="btn btn-info w-100">Enviar pedido</button>
    </form>

</div>

<script>
document.querySelectorAll('.btn-adotar').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('nome_animal').value = btn.dataset.nome || '';
        document.getElementById('tipo').value       = btn.dataset.tipo || '';
        document.getElementById('raca').value       = btn.dataset.raca || '';
        document.getElementById('idade').value      = btn.dataset.idade || '';
        document.getElementById('sexo').value       = btn.dataset.sexo || '';

        document.getElementById('form-adocao').scrollIntoView({behavior:'smooth'});
    });
});

document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const tipo = btn.dataset.tipo;

        document.querySelectorAll('.animal-card').forEach(card => {
            card.style.display = (tipo === 'Todos' || card.dataset.tipo === tipo) ? '' : 'none';
        });
    });
});
</script>
@endsection
