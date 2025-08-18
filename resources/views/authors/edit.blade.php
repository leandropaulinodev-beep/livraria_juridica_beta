@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Autor</h1>
    <form action="{{ route('authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome do Autor</label>
            <input type="text" name="name" class="form-control" value="{{ $author->name }}" required>
        </div>
        <button class="btn btn-primary">Atualizar</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
