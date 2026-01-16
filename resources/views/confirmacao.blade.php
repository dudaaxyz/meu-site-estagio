@extends('layouts.main')

@section('title', 'Confirmar Adoção')

@section('content')
<div class="container py-4" style="max-width: 850px;">

    <h2 class="text-center text-info mb-4">Confirmar Adoção 🐾</h2>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- CARD DO ANIMAL --}}
   <div class="row">
    <div class="col-md-5">
        <img src="{{ $animal->foto }}" class="img-fluid rounded" style="object-fit: cover; width:100%; max-height:280px;">
    </div>

    <div class="col-md-7">
        <h3 class="text-info mb-3">{{ $animal->nome }}</h3>

        <p class="mb-2">
            <strong>Espécie:</strong> {{ $animal->especie ?? 'Não informado' }}<br>
            <strong>Raça:</strong> {{ $animal->raca ?? 'Não informado' }}<br>
            <strong>Idade:</strong> {{ $animal->idade ?? 'Não informado' }}<br>
            <strong>Sexo:</strong> {{ $animal->sexo ?? 'Não informado' }}<br>
            <strong>Status:</strong> {{ $animal->status ?? 'Não informado' }}
        </p>

        <hr>

        <p class="mb-2">
            <strong>Descrição:</strong><br>
            {{ $animal->descricao ?? 'Não informada' }}
        </p>

        <p class="mb-2">
            <strong>Localização:</strong>
            {{ $animal->cidade ?? 'Não informada' }} / {{ $animal->uf ?? '--' }}
        </p>

        <p class="mb-2">
            <strong>WhatsApp do anúncio:</strong>
            {{ $animal->contato_whatsapp ?? 'Não informado' }}
        </p>

        <hr>

        <h5 class="text-info">Responsável pelo anúncio</h5>
        <p class="mb-0">
            <strong>Nome:</strong> {{ $animal->dono->nome ?? 'Não informado' }}<br>
            <strong>Email:</strong> {{ $animal->dono->email ?? 'Não informado' }}
        </p>

        <a href="{{ route('adocao.index') }}" class="btn btn-outline-secondary mt-3">Voltar</a>
    </div>
</div>

    {{-- ERROS DE VALIDAÇÃO --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Corrija os erros abaixo:
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM DE CONFIRMAÇÃO --}}
    <form action="{{ route('adocao.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <input type="hidden" name="animal_id" value="{{ $animal->id }}">

        <h5 class="text-info mb-2">Termo de Responsabilidade</h5>

        <div class="border rounded p-3 mb-3" style="max-height: 220px; overflow:auto; font-size: 14px;">
            <p class="mb-2"><strong>Ao adotar, você se compromete a:</strong></p>
            <ul class="mb-2">
                <li>Garantir alimentação, água e abrigo adequados.</li>
                <li>Não praticar maus-tratos e zelar pelo bem-estar do animal.</li>
                <li>Buscar atendimento veterinário quando necessário.</li>
                <li>Manter o animal em ambiente seguro e com cuidados diários.</li>
            </ul>
            <p class="mb-0">
                Ao marcar “Li e aceito” e assinar abaixo, você confirma que concorda com este termo.
            </p>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="termo_aceito" id="termo_aceito" required
                   {{ old('termo_aceito') ? 'checked' : '' }}>
            <label class="form-check-label" for="termo_aceito">
                Li e aceito o Termo de Responsabilidade
            </label>
        </div>

        <div class="mb-3">
            <label class="form-label">Assinatura (digite seu nome completo)</label>
            <input type="text" name="assinatura" class="form-control" required value="{{ old('assinatura') }}">
        </div>

        <button type="submit" class="btn btn-success w-100">
            Confirmar Adoção ✅
        </button>
    </form>

</div>
@endsection
