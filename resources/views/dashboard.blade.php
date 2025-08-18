@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h1 class="h4">⚖️ Bem-vindo, {{ auth()->user()->name }}</h1>
        <p class="text-muted">Você está logado no sistema da <strong>Livraria Jurídica</strong>.</p>

        <div class="mt-3">
            <a href="{{ route('books.index') }}" class="btn btn-primary">📚 Gerenciar Livros</a>
        </div>
    </div>
</div>
@endsection
