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
    <div class="card shadow-sm mb-4">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="{{ $animal->foto }}"
                     class="img-fluid rounded-start"
                     alt="{{ $animal->nome }}"
                     style="height: 100%; width: 100%; object-fit: cover;">
            </div>

            <div class="col-md-7">
                <div class="card-body">
                    <h4 class="card-title text-info mb-3">{{ $animal->nome }}</h4>

                    <p class="card-text mb-2">
                        <strong>Espécie:</strong> {{ $animal->especie ?? 'Não informado' }}
                    </p>
                    <p class="card-text mb-2">
                        <strong>Raça:</strong> {{ $animal->raca ?? 'Não informado' }}
                    </p>
                    <p class="card-text mb-2">
                        <strong>Idade:</strong> {{ $animal->idade ?? 'Não informado' }}
                    </p>
                    <p class="card-text mb-0">
                        <strong>Sexo:</strong> {{ $animal->sexo ?? 'Não informado' }}
                    </p>

                    <div class="mt-3">
                        <a href="{{ route('adocao.index') }}" class="btn btn-outline-secondary">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
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
