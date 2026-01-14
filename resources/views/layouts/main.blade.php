<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Pet Acolhe')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
        <a class="navbar-brand" href="/">🐾 Pet Acolhe</a>

        <ul class="navbar-nav ms-auto">

            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>

            @if(session('usuario_logado'))

                <li class="nav-item">
                    <span class="nav-link text-white">
                        Olá, {{ session('usuario_nome') }} 👋
                    </span>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/meus-pedidos">Meus pedidos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/adocao">Adotar</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/doacao">Doar</a>
                </li>

                {{-- Link do admin só aparece se for o email admin --}}
                @if(session('usuario_email') === 'mrdrdcardosoferreira@gmail.com')
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="/admin/adocoes">Painel Admin</a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link text-danger" href="/sair">Sair</a>
                </li>

            @else

                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/cadastro">Cadastro</a>
                </li>

            @endif

        </ul>
    </div>
</nav>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>

<footer class="bg-light text-center p-3 mt-5">
    <p class="mb-0">Pet Acolhe © 2026</p>
</footer>

</body>
</html>
