@extends('layouts.main')
@section('title', 'Detalhes do Animal')

@section('content')
<div class="container py-4" style="max-width: 900px;">

    <a href="{{ route('adocao.index') }}" class="btn btn-outline-secondary mb-3">⬅ Voltar</a>

    <div class="card shadow-sm">
        <img src="{{ $animal->foto }}"
             class="card-img-top"
             style="max-height: 420px; object-fit: cover;"
             alt="{{ $animal->nome }}">

        <div class="card-body">
            <h3 class="text-info mb-2">{{ $animal->nome }}</h3>

            <p class="mb-3">
                <strong>Espécie:</strong> {{ $animal->especie ?? '—' }}<br>
                <strong>Raça:</strong> {{ $animal->raca ?: 'Não informado' }}<br>
                <strong>Idade:</strong> {{ $animal->idade ?: 'Não informado' }}<br>
                <strong>Sexo:</strong> {{ $animal->sexo ?: 'Não informado' }}
            </p>

            @if(!empty($animal->descricao))
                <hr>
                <h5 class="text-info">Sobre</h5>
                <p class="mb-0">{{ $animal->descricao }}</p>
            @endif

            <hr>

            <h5 class="text-info">Responsável pelo anúncio</h5>
            <p class="mb-3">
                <strong>Nome:</strong> {{ $animal->dono->nome ?? '—' }}<br>
                <strong>Email:</strong> {{ $animal->dono->email ?? '—' }}<br>
                <strong>WhatsApp:</strong> {{ $animal->contato_whatsapp ?: '—' }}<br>
                <strong>Local:</strong>
                {{ $animal->cidade ?: '—' }} {{ $animal->uf ? '/'.$animal->uf : '' }}
            </p>

            <a href="{{ route('adocao.confirmar', $animal->id) }}" class="btn btn-success w-100">
                Quero Adotar ✅
            </a>
        </div>
    </div>
</div>


@endsection
