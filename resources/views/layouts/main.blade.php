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
            <li class="nav-item">
                <a class="nav-link" href="/auth">Login/Cadastro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/adocao">Adotar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/doacao">Doar</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    @yield('content')
</div>

<footer class="bg-light text-center p-3 mt-5">
    <p class="mb-0">Pet Acolhe © 2026</p>
</footer>

@yield('scripts')

</body>
</html>
