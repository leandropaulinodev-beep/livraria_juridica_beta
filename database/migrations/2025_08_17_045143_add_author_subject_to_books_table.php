<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // 🔗 Relacionamento com authors
            $table->foreignId('author_id')
                  ->nullable()
                  ->constrained('authors')
                  ->nullOnDelete()
                  ->after('id');

            // 🔗 Relacionamento com subjects
            $table->foreignId('subject_id')
                  ->nullable()
                  ->constrained('subjects')
                  ->nullOnDelete()
                  ->after('author_id');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['subject_id']);
            $table->dropColumn(['author_id', 'subject_id']);
        });
    }
};
