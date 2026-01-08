@extends('layouts.main')

@section('title', 'Cadastro')

@section('content')
<h1>Cadastro de Usuário</h1>

@if(session('success'))
    <p class="text-success">{{ session('success') }}</p>
@endif

<form action="/cadastro" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Cadastrar</button>
</form>
@endsection
