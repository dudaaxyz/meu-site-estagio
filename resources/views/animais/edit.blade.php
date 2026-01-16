@extends('layouts.main')
@section('title', 'Editar Animal')

@section('content')
<div class="container py-4" style="max-width: 800px;">
    <h2 class="text-info mb-3">Editar Animal</h2>

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

    <form method="POST" action="{{ route('animais.update', $animal->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Nome</label>
                <input class="form-control" name="nome" value="{{ old('nome', $animal->nome) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Espécie</label>
                <select class="form-select" name="especie" required>
                    <option value="Cachorro" {{ old('especie', $animal->especie)=='Cachorro'?'selected':'' }}>Cachorro</option>
                    <option value="Gato" {{ old('especie', $animal->especie)=='Gato'?'selected':'' }}>Gato</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Raça</label>
                <input class="form-control" name="raca" value="{{ old('raca', $animal->raca) }}">
            </div>

            {{-- ✅ IDADE LIVRE (TEXTO) --}}
            <div class="col-md-6">
                <label class="form-label">Idade</label>
                <input
                    class="form-control"
                    name="idade"
                    value="{{ old('idade', $animal->idade) }}"
                    placeholder="Ex: 2 meses, 1 ano, filhote">
            </div>

            <div class="col-md-6">
                <label class="form-label">Sexo</label>
                <select class="form-select" name="sexo">
                    <option value="" {{ old('sexo', $animal->sexo)==''?'selected':'' }}>Não informado</option>
                    <option value="Macho" {{ old('sexo', $animal->sexo)=='Macho'?'selected':'' }}>Macho</option>
                    <option value="Fêmea" {{ old('sexo', $animal->sexo)=='Fêmea'?'selected':'' }}>Fêmea</option>
                </select>
            </div>

            {{-- FOTO ATUAL --}}
            <div class="col-12">
                <label class="form-label">Foto atual</label><br>
                <img src="{{ $animal->foto }}" alt="Foto atual" style="max-width: 250px; border-radius: 8px;">
            </div>

            {{-- UPLOAD OPCIONAL --}}
            <div class="col-12">
                <label class="form-label">Trocar foto (opcional)</label>
                <input class="form-control" type="file" name="foto">
                <small class="text-muted">Se não escolher outra imagem, a atual será mantida.</small>
            </div>

            <div class="col-12">
                <label class="form-label">Descrição</label>
                <textarea class="form-control" name="descricao" rows="3">{{ old('descricao', $animal->descricao) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Cidade</label>
                <input class="form-control" name="cidade" value="{{ old('cidade', $animal->cidade) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">UF</label>
                <input class="form-control" name="uf" value="{{ old('uf', $animal->uf) }}" maxlength="2">
            </div>

            <div class="col-12">
                <label class="form-label">WhatsApp</label>
                <input class="form-control" name="contato_whatsapp" value="{{ old('contato_whatsapp', $animal->contato_whatsapp) }}">
            </div>

        </div>

        <button class="btn btn-success w-100 mt-3">Salvar alterações ✅</button>
    </form>
</div>


@endsection
