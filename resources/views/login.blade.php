@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">

        <h3 class="text-center text-info mb-4">Entrar</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>

            <button class="btn btn-info w-100">Entrar</button>

            <div class="text-center mt-3">
                <a href="/cadastro">Não tem conta? Cadastre-se</a>
            </div>
        </form>

    </div>
</div>
@endsection
