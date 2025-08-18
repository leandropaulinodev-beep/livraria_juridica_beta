@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-4">📊 Quantidade de livros cadastrados por assunto</h1>

    <div class="card p-4" style="max-width: 500px; margin: auto;">
        <canvas id="booksChart" width="300" height="300"></canvas>
    </div>

    <div class="mt-3 text-center">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">⬅️ Voltar à Lista de Livros</a>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const labels = @json($labels);
    const data = @json($totals);

    const colorMap = {
        'Direito Constitucional': 'rgba(54, 162, 235, 0.7)',
        'Direito Penal': 'rgba(255, 99, 132, 0.7)',
        'Direito Civil': 'rgba(255, 206, 86, 0.7)',
        'Direito Administrativo': 'rgba(75, 192, 192, 0.7)',
        'Direito Tributário': 'rgba(153, 102, 255, 0.7)',
    };

    const backgroundColors = labels.map(label => colorMap[label] ?? 'rgba(201, 203, 207, 0.7)');
    const borderColors = backgroundColors.map(c => c.replace('0.7','1'));

    const ctx = document.getElementById('booksChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels.length ? labels : ['Sem dados'],
            datasets: [{
                data: data.length ? data : [0],
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'right' },
                title: { display: true, text: 'Gráfio de livros cadastrados' }
            },
            layout: { padding: 10 },
            radius: '70%' // pizza ainda menor
        }
    });
});
</script>
@endsection
