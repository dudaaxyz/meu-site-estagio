@extends('layouts.main')

@section('title', 'Meus pedidos')

@section('content')
<h2 class="mb-4 text-info text-center">Meus pedidos de adoção</h2>

@if($pedidos->count() == 0)
    <div class="alert alert-info text-center">
        Você ainda não fez nenhum pedido de adoção.
    </div>
@else
<table class="table table-bordered text-center">
    <thead class="table-info">
        <tr>
            <th>Animal</th>
            <th>Status</th>
            <th>Mensagem</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $p)
        <tr>
          <td>
    {{ $p->animal->nome ?? '—' }}
</td>


            <td>
                
                @if($p->status == 'pendente')
                    <span class="badge bg-warning">Pendente</span>
                @elseif($p->status == 'aprovado')
                    <span class="badge bg-success">Aprovado</span>
                @else
                    <span class="badge bg-danger">Rejeitado</span>
                @endif
            </td>

            <td>
                @if($p->status == 'pendente')
                    ⏳ Seu pedido está sendo analisado.
                @elseif($p->status == 'aprovado')
                    🎉 <strong>Parabéns!</strong> Sua adoção foi aprovada.
                @else
                    ❌ Infelizmente seu pedido foi recusado.
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
