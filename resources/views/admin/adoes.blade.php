@extends('layouts.main')

@section('title', 'Admin - Adoções')

@section('content')
<h2 class="text-center text-info mb-4">Painel Admin - Pedidos de Adoção</h2>

@if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif

@if($pedidos->count() === 0)
    <div class="alert alert-info text-center">Nenhum pedido no momento.</div>
@else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-info">
                <tr>
                    <th>#</th>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Animal</th>
                    <th>Tipo</th>
                    <th>Raça</th>
                    <th>Idade</th>
                    <th>Sexo</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pedidos as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nome_usuario ?? '-' }}</td>
                    <td>{{ $p->email_usuario ?? '-' }}</td>
                    <td>{{ $p->telefone ?? '-' }}</td>
                    <td>{{ $p->nome_animal ?? '-' }}</td>
                    <td>{{ $p->tipo ?? '-' }}</td>
                    <td>{{ $p->raca ?? '-' }}</td>
                    <td>{{ $p->idade ?? '-' }}</td>
                    <td>{{ $p->sexo ?? '-' }}</td>
                    <td>
                        @if($p->status == 'pendente')
                            <span class="badge bg-warning text-dark">Pendente</span>
                        @elseif($p->status == 'aprovado')
                            <span class="badge bg-success">Aprovado</span>
                        @else
                            <span class="badge bg-danger">Rejeitado</span>
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        @if($p->status == 'pendente')
                            <form method="POST" action="{{ route('admin.adocoes.aprovar', $p->id) }}">
                                @csrf
                                <button class="btn btn-success btn-sm" type="submit">Aprovar</button>
                            </form>

                            <form method="POST" action="{{ route('admin.adocoes.rejeitar', $p->id) }}">
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit">Rejeitar</button>
                            </form>
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
