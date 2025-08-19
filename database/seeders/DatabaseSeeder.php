<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Author;
use App\Models\Subject;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed do banco.
     */
    public function run(): void
    {
        // 👤 Usuário Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // senha de teste
        ]);

        // Autores
        $author1 = Author::create(['name' => 'Machado de Assis']);
        $author2 = Author::create(['name' => 'Clarice Lispector']);

        // Assuntos
        $subject1 = Subject::create(['name' => 'Direito Constitucional']);
        $subject2 = Subject::create(['name' => 'Direito Penal']);

        // Livros
        Book::create([
            'title' => 'Dom Casmurro',
            'year' => 1899,
            'isbn' => '1234567890',
            'author_id' => $author1->id,
            'subject_id' => $subject1->id,
        ]);

        Book::create([
            'title' => 'A Hora da Estrela',
            'year' => 1977,
            'isbn' => '0987654321',
            'author_id' => $author2->id,
            'subject_id' => $subject2->id,
        ]);
    }
}
