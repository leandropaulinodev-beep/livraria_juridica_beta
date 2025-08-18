@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">📚 Lista de Livros</h1>

        <div>
            <a href="{{ route('books.create') }}" class="btn btn-success me-2">➕ Novo Livro</a>
            <a href="{{ route('books.import.form') }}" class="btn btn-primary me-2">⬆️ Importar CSV</a>
            <a href="{{ route('books.report.pdf') }}" class="btn btn-danger me-2">📑 Exportar PDF</a>
            <a href="{{ route('books.chart') }}" class="btn btn-info">📊 Dashboard</a>
        </div>
    </div>

    {{-- Formulário de busca --}}
    <form method="GET" action="{{ route('books.index') }}" class="mb-3 d-flex">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control me-2" placeholder="Buscar por título, autor ou assunto...">
        <button type="submit" class="btn btn-outline-dark">🔍 Buscar</button>
    </form>

    {{-- Mensagens de sucesso --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabela de livros --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Assunto</th>
                    <th>Ano</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->subject->name }}</td>
                    <td>{{ $book->year ?? '-' }}</td>
                    <td>{{ $book->price ? 'R$ '.number_format($book->price, 2, ',', '.') : '-' }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir?')">🗑️ Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Nenhum livro encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Numeração das páginas --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- Estilo customizado da paginação --}}
<style>
    .pagination {
        font-size: 0.85rem;
        margin: 0;
    }

    .pagination .page-item .page-link {
        padding: 0.25rem 0.5rem;
        min-width: 2rem;
        text-align: center;
    }

    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        padding: 0.25rem 0.75rem;
    }
</style>
@endsection
