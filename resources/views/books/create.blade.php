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
            <input type="number" name="year" id="year" class="form-control">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="R$ 0,00">
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

    priceInput.addEventListener('input', function(e) {
        let value = e.target.value;

        // Remove tudo que não é número
        value = value.replace(/\D/g, '');

        if(!value) {
            e.target.value = '';
            return;
        }

        // Converte para decimal
        value = (value / 100).toFixed(2);

        // Troca ponto por vírgula
        value = value.replace('.', ',');

        // Formata com R$ (opcional)
        e.target.value = 'R$ ' + value;
    });

    // Remove "R$ " antes de enviar o formulário
    priceInput.form.addEventListener('submit', function() {
        priceInput.value = priceInput.value.replace('R$ ', '').replace(',', '.');
    });
});
</script>
@endsection
