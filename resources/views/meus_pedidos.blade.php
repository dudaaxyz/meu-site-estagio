@extends('layouts.main')

@section('title', 'Meus pedidos')

@section('content')
<h2 class="text-center text-info mb-4">Meus pedidos de adoção</h2>

@if($pedidos->count() === 0)
    <div class="alert alert-info text-center">Você ainda não enviou nenhum pedido.</div>
@else
    @foreach($pedidos as $p)
        <div class="card mb-3 p-3">
            <h5 class="mb-1">Animal: <strong>{{ $p->nome_animal }}</strong></h5>
            <div>Tipo: {{ $p->tipo }} | Raça: {{ $p->raca }} | Idade: {{ $p->idade }} | Sexo: {{ $p->sexo }}</div>

            <div class="mt-2">
                Status:
                @if($p->status === 'pendente')
                    <span class="badge bg-warning text-dark">Pendente</span>
                @elseif($p->status === 'aprovado')
                    <span class="badge bg-success">Aprovado ✅</span>
                @elseif($p->status === 'rejeitado')
                    <span class="badge bg-danger">Rejeitado ❌</span>
                @else
                    <span class="badge bg-secondary">{{ $p->status }}</span>
                @endif
            </div>
        </div>
    @endforeach
@endif
@endsection
