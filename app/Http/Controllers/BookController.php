<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    /**
     * Lista todos os livros + busca
     */
    public function index(Request $request)
    {
        $query = Book::with(['author', 'subject']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhereHas('author', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('subject', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $books = $query->paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        $authors = Author::all();
        $subjects = Subject::all();

        return view('books.create', compact('authors', 'subjects'));
    }

    /**
     * Salvar novo livro
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'author_id'  => 'required|exists:authors,id',
            'subject_id' => 'required|exists:subjects,id',
            'year'       => 'nullable|integer',
            'price'      => 'nullable|string',
        ]);

        $data = $request->all();

        if(!empty($data['price'])){
            $data['price'] = str_replace(['R$', '.', ','], ['', '', '.'], $data['price']);
            $data['price'] = number_format((float)$data['price'], 2, '.', '');
        }

        Book::create($data);

        return redirect()->route('books.index')
            ->with('success', '📚 Livro cadastrado com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $subjects = Subject::all();

        return view('books.edit', compact('book', 'authors', 'subjects'));
    }

    /**
     * Atualizar livro
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'author_id'  => 'required|exists:authors,id',
            'subject_id' => 'required|exists:subjects,id',
            'year'       => 'nullable|integer',
            'price'      => 'nullable|string',
        ]);

        $data = $request->all();

        if(!empty($data['price'])){
            $data['price'] = str_replace(['R$', '.', ','], ['', '', '.'], $data['price']);
            $data['price'] = number_format((float)$data['price'], 2, '.', '');
        }

        $book->update($data);

        return redirect()->route('books.index')
            ->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Excluir livro
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', '🗑️ Livro excluído com sucesso!');
    }

    /**
     * Formulário de importação CSV
     */
    public function importForm()
    {
        return view('books.import');
    }

    /**
     * Importar livros via CSV
     */
    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file, "r");

        $header = fgetcsv($handle, 1000, ",");
        $imported = 0;
        $skipped = 0;

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $row = array_combine($header, $data);

            // Validação manual para pular linhas inválidas
            $authorExists = Author::where('id', $row['author_id'] ?? 0)->exists();
            $subjectExists = Subject::where('id', $row['subject_id'] ?? 0)->exists();

            if (!$authorExists || !$subjectExists || empty($row['title'])) {
                $skipped++;
                continue; // pula esta linha
            }

            if(!empty($row['price'])){
                $row['price'] = str_replace(['R$', '.', ','], ['', '', '.'], $row['price']);
                $row['price'] = number_format((float)$row['price'], 2, '.', '');
            }

            Book::create($row);
            $imported++;
        }

        fclose($handle);

        return redirect()->route('books.index')
            ->with('success', "📥 $imported livros importados com sucesso!");
    }

    /**
     * 📑 Gerar relatório em PDF dos livros
     */
    public function reportPdf()
    {
        $books = Book::with(['author', 'subject'])->get();

        $pdf = Pdf::loadView('books.report', compact('books'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('relatorio_livros.pdf');
    }

    /**
     * 📊 Gerar gráfico de livros por assunto
     */
    public function chart()
    {
        $data = \DB::table('books')
            ->join('subjects', 'books.subject_id', '=', 'subjects.id')
            ->select('subjects.name', \DB::raw('count(books.id) as total'))
            ->groupBy('subjects.name')
            ->get();

        $labels = $data->pluck('name')->toArray();
        $totals = $data->pluck('total')->map(fn($x) => (int)$x)->toArray();

        return view('books.chart', compact('labels', 'totals'));
    }
}
