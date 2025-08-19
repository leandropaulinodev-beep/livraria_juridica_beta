@extends('layouts.app')

@section('content')
<div class="container">
    <h1>📚 Cadastrar Livro</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">Autor</label>
            <select name="author_id" id="author_id" class="form-control" required>
                <option value="">-- Selecione --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subject_id" class="form-label">Assunto</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">-- Selecione --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Ano</label>
            <input type="number" name="year" id="year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="R$ 0,00" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const priceInput = document.getElementById('price');
    const form = priceInput.closest('form');

    // Formata enquanto digita
    priceInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = (value / 100).toFixed(2);
        value = value.replace('.', ',');
        e.target.value = 'R$ ' + value;
    });

    // Valida antes de enviar o formulário
    form.addEventListener('submit', function(e) {
        const value = priceInput.value.replace(/[^\d,]/g, '').replace(',', '.'); // pega só número
        if (parseFloat(value) === 0) {
            e.preventDefault(); // bloqueia envio
            alert('Valor R$ 0,00 não é permitido!');
            priceInput.focus();
        }
    });
});
</script>
@endsection
