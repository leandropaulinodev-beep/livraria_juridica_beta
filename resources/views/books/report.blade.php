<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Livros</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #333; color: #fff; }
    </style>
</head>
<body>
    <h1>📚 Relatório de Livros</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Assunto</th>
                <th>Ano</th>
                <th>Preço (R$)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name ?? '-' }}</td>
                    <td>{{ $book->subject->name ?? '-' }}</td>
                    <td>{{ $book->year ?? '-' }}</td>
                    <td>{{ $book->price ? number_format($book->price, 2, ',', '.') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
