# ⚖️ Livraria Jurídica

![Laravel](https://img.shields.io/badge/Laravel-10-orange)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue)
![License](https://img.shields.io/badge/License-MIT-green)

Sistema completo para gerenciar livros jurídicos, autores e assuntos, com importação via CSV, relatórios PDF e gráficos de análise.  
Feito com **Laravel**, **Bootstrap 5** e **Chart.js**, seguindo boas práticas de MVC e UX.

---

##  Funcionalidades

-  **CRUD de livros, autores e assuntos**  
-  **Importação de livros via CSV**  
-  **Geração de relatórios em PDF**  
-  **Dashboard com gráfico de livros por assunto**  
-  **Login e registro de usuários**  
-  **Layout responsivo e moderno**  

---

## 🛠 Tecnologias Utilizadas

- **Backend:** Laravel 10  
- **Frontend:** Blade + Bootstrap 5  
- **Banco de Dados:** MySQL (Amazon RDS)  
- **Relatórios PDF:** DomPDF  
- **Gráficos:** Chart.js  

---

## Estrutura do Projeto

livraria-juridica/
│
├─ app/Http/Controllers/ # Controllers (Book, Author, Subject, Auth)
├─ app/Models/ # Models e relacionamentos
├─ database/migrations/ # Tabelas do banco
├─ resources/views/ # Views Blade (layouts, books, authors, subjects)
├─ routes/web.php # Rotas do projeto
├─ public/ # Arquivos públicos (CSS, JS)
├─ .env # Configurações de ambiente (não subir no GitHub!)
└─ composer.json

---

## Instalação Local

1. Clone o repositório:

```bash
git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd livraria-juridica
Instale dependências:

bash
composer install
npm install
npm run dev
Configure o .env com seu banco de dados:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
Rode migrations e seeders:

bash
php artisan migrate
php artisan db:seed
Inicie o servidor local:

bash
php artisan serve
Acesse: http://localhost:8000