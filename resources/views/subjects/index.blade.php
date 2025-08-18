@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📖 Lista de Assuntos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">➕ Novo Assunto</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>
                        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">🗑️ Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2" class="text-center">Nenhum assunto encontrado.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
