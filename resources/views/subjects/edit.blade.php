@extends('layouts.app')

@section('content')
<div class="container">
    <h1>✏️ Editar Assunto</h1>

    <form action="{{ route('subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $subject->name }}" required>
        </div>
        <button class="btn btn-success">Atualizar</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
