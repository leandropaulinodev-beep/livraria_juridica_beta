@if ($paginator->hasPages())
    <div class="d-flex flex-column align-items-center mb-3">
        {{-- Linha de resumo --}}
        <div class="mb-2 text-muted">
            Mostrando {{ $paginator->firstItem() }} a {{ $paginator->lastItem() }} de {{ $paginator->total() }} resultados
        </div>

        {{-- Links da paginação --}}
        <ul class="pagination mb-0">
            {{-- Botão "Anterior" --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                </li>
            @endif

            {{-- Números das páginas --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Botão "Próximo" --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </div>

    {{-- Estilos customizados --}}
    <style>
        .pagination {
            font-size: 0.85rem;
        }

        .pagination .page-item .page-link {
            padding: 0.25rem 0.5rem;
            min-width: 2rem;
            text-align: center;
        }

        /* Botões < e > menores */
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            font-size: 0.65rem;
            padding: 0.15rem 0.35rem;
            min-width: 1.5rem;
        }

        .pagination .page-item.active .page-link {
            background-color: #343a40;
            border-color: #343a40;
            color: #fff;
        }
    </style>
@endif
