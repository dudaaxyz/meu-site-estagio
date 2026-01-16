@extends('layouts.main')
@section('title', 'Cadastrar Animal')

@section('content')
<div class="container py-4" style="max-width: 800px;">
    <h2 class="text-info mb-3">Cadastrar Animal para Adoção</h2>

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

    <form method="POST" action="{{ route('animais.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Nome</label>
                <input class="form-control" name="nome" value="{{ old('nome') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Espécie</label>
                <select class="form-select" name="especie" required>
                    <option value="">Selecione</option>
                    <option value="Cachorro" {{ old('especie')=='Cachorro'?'selected':'' }}>Cachorro</option>
                    <option value="Gato" {{ old('especie')=='Gato'?'selected':'' }}>Gato</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Raça</label>
                <input class="form-control" name="raca" value="{{ old('raca') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Idade</label>
                <input class="form-control" name="idade" value="{{ old('idade') }}" placeholder="Ex: 2 meses, 1 ano, filhote">
            </div>

            <div class="col-md-6">
                <label class="form-label">Sexo</label>
                <select class="form-select" name="sexo">
                    <option value="">Não informado</option>
                    <option value="Macho" {{ old('sexo')=='Macho'?'selected':'' }}>Macho</option>
                    <option value="Fêmea" {{ old('sexo')=='Fêmea'?'selected':'' }}>Fêmea</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Foto do animal</label>
                <input class="form-control" type="file" name="foto" required>
            </div>

            <div class="col-12">
                <label class="form-label">Descrição</label>
                <textarea class="form-control" name="descricao" rows="3">{{ old('descricao') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Cidade</label>
                <input class="form-control" name="cidade" value="{{ old('cidade') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">UF</label>
                <input class="form-control" name="uf" value="{{ old('uf') }}" maxlength="2" placeholder="AL">
            </div>

            <div class="col-12">
                <label class="form-label">WhatsApp</label>
                <input class="form-control" name="contato_whatsapp" value="{{ old('contato_whatsapp') }}" placeholder="Ex: 82999999999">
            </div>

        </div>

        <button class="btn btn-success w-100 mt-4">Publicar anúncio ✅</button>
    </form>
</div>
@endsection
