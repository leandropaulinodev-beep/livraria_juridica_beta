@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Novo Autor</h1>
    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome do Autor</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Salvar</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
