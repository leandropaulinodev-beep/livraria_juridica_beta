@extends('layouts.app')

@section('content')
<div class="container">
    <h1>✏️ Editar Livro</h1>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">Autor</label>
            <select name="author_id" id="author_id" class="form-control" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">Assunto</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $book->subject_id == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Ano</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ $book->year }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="text" name="price" id="price" class="form-control" 
                   value="{{ $book->price ? 'R$ '.number_format($book->price, 2, ',', '.') : '' }}">
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const priceInput = document.getElementById('price');

    priceInput.addEventListener('input', function(e) {
        let value = e.target.value;

        value = value.replace(/\D/g, '');
        value = (value / 100).toFixed(2);
        value = value.replace('.', ',');
        e.target.value = 'R$ ' + value;
    });
});
</script>
@endsection
@endsection
