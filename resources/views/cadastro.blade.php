@extends('layouts.main')

@section('title', 'Login / Cadastro')

@section('content')

<div class="container" style="max-width: 420px">

    <!-- LOGIN -->
    <div id="login-box">
        <h2 class="text-center mb-3">Login</h2>

        @if(session('erro_login'))
            <p class="text-danger text-center">{{ session('erro_login') }}</p>
        @endif

        <form action="/login" method="POST">
            @csrf

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
                <label>Endereço</label>
                <input type="text" name="endereco" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Entrar</button>
        </form>

        <p class="text-center mt-3">
            Não tem conta?
            <a href="#" onclick="mostrarCadastro()">Cadastre-se</a>
        </p>
    </div>

    <!-- CADASTRO (ESCONDIDO) -->
    <div id="cadastro-box" style="display:none;">
        <h2 class="text-center mb-3">Cadastro</h2>

        @if(session('success'))
            <p class="text-success text-center">{{ session('success') }}</p>
        @endif

        <form action="/cadastro" method="POST">
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

            <button class="btn btn-success w-100">Cadastrar</button>
        </form>

        <p class="text-center mt-3">
            Já tem conta?
            <a href="#" onclick="mostrarLogin()">Fazer login</a>
        </p>
    </div>

</div>

@endsection


@section('scripts')
<script>
    function mostrarCadastro() {
        document.getElementById('login-box').style.display = 'none';
        document.getElementById('cadastro-box').style.display = 'block';
    }

    function mostrarLogin() {
        document.getElementById('cadastro-box').style.display = 'none';
        document.getElementById('login-box').style.display = 'block';
    }
</script>
@endsection
