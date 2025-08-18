<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Livraria Jurídica') }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body { height: 100%; }
        body { display: flex; flex-direction: column; background-color: #f8f9fa; }

        .navbar { background-color: #1a237e; }
        .navbar-brand, .nav-link, .dropdown-item { color: #f8f9fa !important; }
        .navbar-brand span { color: #ffd700; }
        .nav-link:hover { color: #ffd700 !important; }

        main { flex: 1 0 auto; }

        footer { flex-shrink: 0; background: #1a237e; color: #f8f9fa; padding: 15px 0; text-align: center; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                ⚖️ <span>Livraria Jurídica</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" aria-controls="navbarNav" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">🏛 Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">📚 Livros</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('authors.index') }}">✍️ Autores</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('subjects.index') }}">📖 Assuntos</a></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">🚪 Sair</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">🔑 Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTEÚDO -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <p>&copy; {{ date('Y') }} Teste Leandro Paulino - Todos os direitos reservados.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Permite que cada view insira seus scripts (ex: Chart.js) -->
    @yield('scripts')
</body>
</html>
