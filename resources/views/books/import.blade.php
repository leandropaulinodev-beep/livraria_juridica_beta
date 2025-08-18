@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h1 class="h4 mb-4">⬆️ Importar Livros via CSV</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Erro!</strong> Verifique os problemas abaixo:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.import.csv') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Arquivo CSV</label>
                <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                <div class="form-text">
                    O arquivo deve conter as colunas: <strong>titulo, autor, ano, preço</strong>.
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">⬅️ Voltar</a>
                <button type="submit" class="btn btn-success">📥 Importar</button>
            </div>
        </form>
    </div>
</div>
@endsection
