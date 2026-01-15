@extends('layouts.main')

@section('title', 'Adoção')

@section('content')
<div class="container py-4">

    
    <form method="GET" action="{{ route('adocao.index') }}" class="text-center mb-4">

    <button type="submit" name="especie" value="Todos"
        class="btn btn-info me-2 {{ ($especie ?? 'Todos') == 'Todos' ? 'active' : '' }}">
        🐾 Todos
    </button>

    <button type="submit" name="especie" value="Cachorro"
        class="btn btn-info me-2 {{ ($especie ?? '') == 'Cachorro' ? 'active' : '' }}">
        🐶 Cachorro
    </button>

    <button type="submit" name="especie" value="Gato"
        class="btn btn-info {{ ($especie ?? '') == 'Gato' ? 'active' : '' }}">
        🐱 Gato
    </button>

</form>


    
    @php
        // ✅ evita erro caso controller não mande $adotados
        $adotados = $adotados ?? [];

        // ✅ dados fixos que você pediu (nome -> idade/sexo/especie)
        $dadosFixos = [
            'Rex'   => ['especie'=>'Cachorro', 'idade'=>'5 meses',  'sexo'=>'Macho'],
            'Mimi'  => ['especie'=>'Gato',     'idade'=>'11 meses', 'sexo'=>'Fêmea'],
            'Bolt'  => ['especie'=>'Cachorro', 'idade'=>'3 anos',   'sexo'=>'Macho'],
            'Luna'  => ['especie'=>'Cachorro', 'idade'=>'2 meses',  'sexo'=>'Fêmea'],
            'Amora' => ['especie'=>'Gato',     'idade'=>'9 meses',  'sexo'=>'Fêmea'],
            'Bob'   => ['especie'=>'Gato',     'idade'=>'1 ano',    'sexo'=>'Macho'],
            'Negão' => ['especie'=>'Cachorro', 'idade'=>'2 meses',  'sexo'=>'Macho'],
            'Bela'  => ['especie'=>'Cachorro', 'idade'=>'2 anos',   'sexo'=>'Fêmea'],
            'Chico' => ['especie'=>'Cachorro', 'idade'=>'2 anos',   'sexo'=>'Macho'],
            'Huck'  => ['especie'=>'Cachorro', 'idade'=>'9 meses',  'sexo'=>'Macho'],
        ];
    @endphp

    @if(isset($animais) && $animais->count() > 0)
        <div class="row g-4" id="animais-container">
            @foreach($animais as $animal)
                @php
                    $nome = $animal->nome ?? '';
                    $fixo = $dadosFixos[$nome] ?? null;

                    // ✅ só mostra se o banco diz que está disponível
                    // (mesmo que algum controller traga outros, isso bloqueia)
                    $status = $animal->status ?? 'disponível';
                    if ($status !== 'disponível') continue;

                    // ✅ some se já estiver na lista de aprovados (se existir)
                    if (in_array($nome, $adotados)) continue;

                    // ✅ especie: banco (especie) ou fixo
                    $especie = $animal->especie ?? ($fixo['especie'] ?? 'Não informado');

                    // ✅ raça (do banco)
                    $raca = $animal->raca ?? null;
                    $racaTexto = ($raca && trim($raca) !== '') ? $raca : 'Não informado';

                    // ✅ sexo: banco ou fixo
                    $sexo = $animal->sexo ?? ($fixo['sexo'] ?? 'Não informado');
                    if (!$sexo || trim($sexo) === '') $sexo = 'Não informado';

                    // ✅ idade: se banco for número (MESES), converte; senão usa fixo
                    $idadeTexto = 'Não informado';
                    if (is_numeric($animal->idade)) {
                        $m = (int) $animal->idade;
                        if ($m <= 0) $idadeTexto = $fixo['idade'] ?? 'Não informado';
                        elseif ($m < 12) $idadeTexto = $m . ' meses';
                        elseif ($m == 12) $idadeTexto = '1 ano';
                        else $idadeTexto = floor($m/12) . ' anos';
                    } else {
                        $idadeTexto = $fixo['idade'] ?? ($animal->idade ?: 'Não informado');
                    }
                @endphp

                <div class="col-md-4 col-sm-6 animal-card" data-especie="{{ $especie }}">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $animal->foto }}"
                             class="card-img-top"
                             alt="{{ $nome }}"
                             style="height: 250px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $nome }}</h5>

                            <p class="card-text mb-3">
                                Espécie: {{ $especie }}<br>
                                Raça: {{ $racaTexto }}<br>
                                Idade: {{ $idadeTexto }}<br>
                                Sexo: {{ $sexo }}
                            </p>

                            <button
                                type="button"
                                class="btn btn-info mt-auto w-100 btn-adotar"
                                data-animal_id="{{ $animal->id }}"
                                data-nome="{{ $nome }}"
                                data-especie="{{ $especie }}"
                                data-raca="{{ $racaTexto }}"
                                data-idade="{{ $idadeTexto }}"
                                data-sexo="{{ $sexo }}"
                            >
                                <a href="{{ route('adocao.confirmar', $animal->id) }}" class="btn btn-info mt-auto w-100">
    Quero Adotar!
</a>

                            </button>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center">
            Nenhum animal disponível no momento 😢
        </div>
    @endif

    <hr class="my-5">

   

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
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

   
       


@endsection
