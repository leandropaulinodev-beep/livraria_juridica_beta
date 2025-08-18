@extends('layouts.app')

@section('content')
<div class="container">
    <h1>➕ Cadastrar Assunto</h1>

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Salvar</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
