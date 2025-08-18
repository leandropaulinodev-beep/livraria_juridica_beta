@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Autores</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Novo Autor</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        @foreach($authors as $author)
        <tr>
            <td>{{ $author->id }}</td>
            <td>{{ $author->name }}</td>
            <td>
                <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este autor?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
