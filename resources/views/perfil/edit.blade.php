@extends('layouts.main')
@section('title', 'Editar Perfil')

@section('content')
<div class="container py-4" style="max-width: 700px;">

    <h2 class="text-info mb-4">Editar Perfil </h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Corrija os erros:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('perfil.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input class="form-control" name="nome" value="{{ old('nome', $usuario->nome) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" value="{{ old('email', $usuario->email) }}" required>
        </div>

        
        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input class="form-control" type="password" name="senha">
        </div>
        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input class="form-control" name="telefone" value="{{ old('telefone', $usuario->telefone) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input class="form-control" name="endereco" value="{{ old('endereco', $usuario->endereco) }}">
        </div>
        <button class="btn btn-success w-100">Salvar ✅</button>
    </form>

</div>
@endsection
