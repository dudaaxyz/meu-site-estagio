@extends('layouts.main')

@section('title', 'Cadastro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">

        <h3 class="text-center text-info mb-4">Criar conta</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('cadastro.post') }}">
            @csrf

            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>

            
            <div class="mb-3">
                <label>Telefone</label>
                <input type="tel" name="telefone" class="form-control" required>
            </div>

            
            <div class="mb-3">
                <label>Endereco</label>
                <input type="text" name="endereco" class="form-control" required>
            </div>
            <button class="btn btn-info w-100">Cadastrar</button>

            <div class="text-center mt-3">
                <a href="/login">Já tenho conta</a>
            </div>
        </form>

    </div>
</div>
@endsection
