@extends('layouts.main')

@section('title', 'Adoção')

@section('content')
<div class="container py-4">

    <h1 class="mb-4 text-center text-info">Animais disponíveis para adoção 🐾</h1>

    <div class="text-center mb-4">
        <button class="btn btn-info me-2 filter-btn" data-tipo="Todos">Todos</button>
        <button class="btn btn-info me-2 filter-btn" data-tipo="Cachorro">Cachorro 🐶</button>
        <button class="btn btn-info filter-btn" data-tipo="Gato">Gato 🐱</button>
    </div>

    @php
        // ✅ evita erro caso controller não mande $adotados
        $adotados = $adotados ?? [];

        // ✅ dados fixos que você pediu (nome -> idade/sexo/tipo)
        $dadosFixos = [
            'Rex'   => ['tipo'=>'Cachorro', 'idade'=>'5 meses',  'sexo'=>'Macho'],
            'Mimi'  => ['tipo'=>'Gato',     'idade'=>'11 meses', 'sexo'=>'Fêmea'],
            'Bolt'  => ['tipo'=>'Cachorro', 'idade'=>'3 anos',   'sexo'=>'Macho'],
            'Luna'  => ['tipo'=>'Cachorro', 'idade'=>'2 meses',  'sexo'=>'Fêmea'],
            'Amora' => ['tipo'=>'Gato',     'idade'=>'9 meses',  'sexo'=>'Fêmea'],
            'Bob'   => ['tipo'=>'Gato',     'idade'=>'1 ano',    'sexo'=>'Macho'],
            'Negão' => ['tipo'=>'Cachorro', 'idade'=>'2 meses',  'sexo'=>'Macho'],
            'Bela'  => ['tipo'=>'Cachorro', 'idade'=>'2 anos',   'sexo'=>'Fêmea'],
            'Chico' => ['tipo'=>'Cachorro', 'idade'=>'2 anos',   'sexo'=>'Macho'],
            'Huck'  => ['tipo'=>'Cachorro', 'idade'=>'9 meses',  'sexo'=>'Macho'],
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

                    // ✅ tipo: banco (especie) ou fixo
                    $tipo = $animal->especie ?? ($fixo['tipo'] ?? 'Não informado');

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

                <div class="col-md-4 col-sm-6 animal-card" data-tipo="{{ $tipo }}">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $animal->foto }}"
                             class="card-img-top"
                             alt="{{ $nome }}"
                             style="height: 250px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $nome }}</h5>

                            <p class="card-text mb-3">
                                Tipo: {{ $tipo }}<br>
                                Raça: {{ $racaTexto }}<br>
                                Idade: {{ $idadeTexto }}<br>
                                Sexo: {{ $sexo }}
                            </p>

                            <button
                                type="button"
                                class="btn btn-info mt-auto w-100 btn-adotar"
                                data-animal_id="{{ $animal->id }}"
                                data-nome="{{ $nome }}"
                                data-tipo="{{ $tipo }}"
                                data-raca="{{ $racaTexto }}"
                                data-idade="{{ $idadeTexto }}"
                                data-sexo="{{ $sexo }}"
                            >
                                Quero Adotar!
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

    <h3 class="text-center text-info mb-3" id="form-adocao">Pedido de adoção 🐾</h3>

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

    <form action="{{ route('adocao.store') }}" method="POST" class="mx-auto" style="max-width: 700px;">
        @csrf

        <input type="hidden" name="animal_id" id="animal_id">

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Animal escolhido</label>
                <input type="text" id="nome_animal" class="form-control" readonly required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tipo</label>
                <input type="text" id="tipo" class="form-control" readonly required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Raça</label>
                <input type="text" id="raca" class="form-control" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label">Idade</label>
                <input type="text" id="idade" class="form-control" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label">Sexo</label>
                <input type="text" id="sexo" class="form-control" readonly>
            </div>
        </div>

        <div class="card p-3 mb-3">
            <h5 class="text-info mb-2">Termo de Responsabilidade</h5>

            <div style="max-height: 180px; overflow: auto; font-size: 14px;">
                <ul>
                    <li>Sou responsável pelo bem-estar do animal adotado.</li>
                    <li>Comprometo-me a não praticar maus-tratos.</li>
                    <li>Buscarei atendimento veterinário quando necessário.</li>
                </ul>
                <p class="mb-0">Ao marcar “Li e aceito” e assinar abaixo, confirmo que concordo.</p>
            </div>

            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" name="termo_aceito" id="termo_aceito" required>
                <label class="form-check-label" for="termo_aceito">
                    Li e aceito o Termo de Responsabilidade
                </label>
            </div>

            <div class="mt-3">
                <label class="form-label">Assinatura (digite seu nome)</label>
                <input type="text" name="assinatura" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-info w-100">Enviar pedido</button>
    </form>

</div>

<script>
// FILTRO
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const tipo = btn.getAttribute('data-tipo');

        document.querySelectorAll('.animal-card').forEach(card => {
            const tipoCard = card.getAttribute('data-tipo');
            card.style.display = (tipo === 'Todos' || tipoCard === tipo) ? '' : 'none';
        });
    });
});

// BOTÃO "QUERO ADOTAR" -> preenche formulário
document.querySelectorAll('.btn-adotar').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('animal_id').value = btn.dataset.animal_id || '';
        document.getElementById('nome_animal').value = btn.dataset.nome || '';
        document.getElementById('tipo').value = btn.dataset.tipo || '';
        document.getElementById('raca').value = btn.dataset.raca || 'Não informado';
        document.getElementById('idade').value = btn.dataset.idade || 'Não informado';
        document.getElementById('sexo').value = btn.dataset.sexo || 'Não informado';

        document.getElementById('form-adocao').scrollIntoView({ behavior: 'smooth' });
    });
});
</script>
@endsection
