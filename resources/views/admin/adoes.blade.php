@extends('layouts.main')

@section('title', 'Admin - Adoções')

@section('content')
<div class="container py-4">

    <h2 class="text-info mb-4">Painel de Adoções (Admin) 🐾</h2>

    
    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    @if(isset($adoes) && $adoes->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-info">
                    <tr>
                        <th>#</th>
                        <th>Usuário</th>
                        <th>Animal</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($adoes as $adocao)
                        <tr>
                            <td>{{ $adocao->id }}</td>

                            <td>
                                {{ $adocao->usuario->nome ?? ('Usuário #' . ($adocao->user_id ?? '—')) }}
                            </td>

                            <td>
                                {{ $adocao->animal->nome ?? ('Animal #' . ($adocao->animal_id ?? '—')) }}
                            </td>

                            <td>
                                @php $st = $adocao->status ?? '—'; @endphp

                                @if($st === 'pendente')
                                    <span class="badge bg-warning text-dark">PENDENTE</span>
                                @elseif($st === 'aprovado')
                                    <span class="badge bg-success">APROVADO</span>
                                @elseif($st === 'rejeitado')
                                    <span class="badge bg-danger">REJEITADO</span>
                                @else
                                    <span class="badge bg-secondary">{{ strtoupper($st) }}</span>
                                @endif
                            </td>

                            <td>
                                {{ optional($adocao->created_at)->format('d/m/Y H:i') ?? '—' }}
                            </td>

                            <td class="text-center">
                                @if(($adocao->status ?? '') === 'pendente')
                                    <form action="{{ route('admin.adocoes.aprovar', $adocao->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            Aprovar
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.adocoes.rejeitar', $adocao->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            Rejeitar
                                        </button>
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
    @else
        <div class="alert alert-warning text-center">
            Nenhum pedido de adoção encontrado.
        </div>
    @endif

</div>
@endsection
