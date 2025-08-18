<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'subject_id',
        'year',
        'price',
    ];

    // Relacionamento: Livro pertence a um autor
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relacionamento: Livro pertence a um assunto
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
