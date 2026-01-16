@extends('layouts.main')
@section('title', 'Meu Perfil')

@section('content')
<div class="container py-4" style="max-width: 700px;">

    <h2 class="text-info mb-4">Meu Perfil </h2>

    <div class="card p-3 shadow-sm">
        <p class="mb-2"><strong>Nome:</strong> {{ $usuario->nome }}</p>
        <p class="mb-2"><strong>Email:</strong> {{ $usuario->email }}</p>
        <p class="mb-2"><strong>Senha:</strong> **************</p>
         <p class="mb-2"><strong>Telefone:</strong> {{ $usuario->telefone }}</p>
              <p class="mb-2"><strong>Endereço:</strong> {{ $usuario->endereco }}</p>
   
        <a href="{{ route('perfil.edit') }}" class="btn btn-info mt-3">Editar perfil</a>
    </div>

</div>
@endsection
