@extends('layouts.main')
@section('title', 'Meus Animais')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-info mb-0">Meus Animais 🐾</h2>
        <a href="{{ route('animais.create') }}" class="btn btn-info">+ Cadastrar Animal</a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if(!isset($animais) || $animais->count() == 0)
        <div class="alert alert-warning text-center">
            Você ainda não cadastrou nenhum animal.
        </div>
    @else
        <div class="row g-4">
            @foreach($animais as $animal)
                <div class="col-md-4 col-sm-6">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $animal->foto }}"
                             class="card-img-top"
                             style="height: 220px; object-fit: cover;"
                             alt="{{ $animal->nome }}">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $animal->nome }}</h5>

                            <p class="mb-3">
                                <strong>Status:</strong> {{ $animal->status ?? '—' }}<br>
                                <strong>Espécie:</strong> {{ $animal->especie ?? '—' }}
                            </p>

                            <a href="{{ route('animais.show', $animal->id) }}"
                               class="btn btn-outline-secondary w-100 mb-2">
                                Ver anúncio
                            </a>

                            <a href="{{ route('animais.edit', $animal->id) }}"
                               class="btn btn-info w-100">
                                Editar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
