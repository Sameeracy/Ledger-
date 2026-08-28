```markdown
# Ledger+ : Financial Management & Transaction Tracking System

## 📌 Project Overview
**Ledger+** is a full-stack personal finance and debt/credit transaction management system engineered with Laravel[cite: 1, 4]. The application provides financial tracking (`you_owe` vs. `they_owe`), real-time balance aggregation, dynamic filtering with query preservation, streamed CSV exports, and downloadable PDF reports[cite: 4]. 

Built strictly following clean architectural principles, the project uses the **Service-Repository Pattern**, **Constructor Dependency Injection**, and **Inversion of Control (IoC)** via the Laravel Service Container[cite: 4].

---

## 🚀 Key Features & Architectural Highlights

### 1. Routing & URL Handling
- **Route Groups & Middleware:** Protected route groups configured with `auth`, `verified`, and `guest` middleware[cite: 4].
- **RESTful Resource Routing:** Fully mapped CRUD actions (`index`, `create`, `store`, `edit`, `update`, `destroy`) via `Route::resource('transactions', ...)`[cite: 4].
- **Implicit Route Model Binding:** Automatically resolves `Transaction $transaction` instances from URI parameters[cite: 4].
- **Security & Signed Routes:** Signed email verification routes and rate limiting via `throttle:6,1`[cite: 4].

### 2. Software Architecture & Clean Code
- **Repository Pattern:** Complete separation of database query logic from business rules via `TransactionRepositoryInterface` and concrete `TransactionRepository`[cite: 4].
- **Service Layer Pattern:** Encapsulates business logic, dashboard aggregation metrics, status calculations, and export pipelines in `TransactionService`[cite: 4].
- **Service Container Bindings (IoC):** Interface-to-implementation bindings declared inside `AppServiceProvider` with constructor dependency injection in controllers[cite: 4].

### 3. Eloquent ORM & Database Layer
- **Relational Integrity:** One-to-Many relationship (`User hasMany Transactions` / `Transaction belongsTo User`)[cite: 4].
- **Attributes & Mass Assignment:** Utilizes modern PHP 8 attributes (`#[Fillable]`, `#[Hidden]`) alongside model `$fillable` configurations[cite: 4].
- **Attribute Casting:** Precision decimal casting (`decimal:2`), date parsing (`date`), and password hashing (`hashed`)[cite: 4].
- **Database Migrations & Aggregations:** Declarative schema migrations with foreign key constraints, indexes, query aggregations (`sum('amount')`), and paginated queries preserving search strings (`withQueryString()`)[cite: 4].

### 4. Authentication, Validation & Security
- **Laravel Breeze Integration:** Full authentication lifecycle (registration, login, password resets, email verification, session invalidation)[cite: 4].
- **Granular Ownership Authorization:** Prevents unauthorized cross-tenant data access by validating ownership and throwing `abort(403)` responses[cite: 4].
- **Form Request & Controller Validation:** Strict payload validation with Form Requests and controller rules (`required`, `numeric`, `in:you_owe,they_owe`)[cite: 4].
- **Web Security:** CSRF protection directives (`@csrf`) and HTTP method spoofing (`@method('PATCH')`, `@method('DELETE')`)[cite: 4].

### 5. Document Generation & Export Engines
- **Streamed CSV/Excel Export:** High-performance streamed data generation using `Symfony\Component\HttpFoundation\StreamedResponse` with UTF-8 BOM encoding for large datasets[cite: 4].
- **PDF Report Generation:** Compiles printable financial statement reports using dynamic Blade views and `Barryvdh\DomPDF\Facade\Pdf`[cite: 4].

### 6. Frontend & Blade Architecture
- **Blade Layouts & Components:** Reusable `<x-app-layout>` shells, named slots (`<x-slot name="header">`), and modular UI components (modals, dropdowns, buttons, input errors)[cite: 4].
- **Bootstrap 5 UI & Vite:** Styled with Bootstrap 5 (configured with `Paginator::useBootstrapFive()`) and asset bundling handled via Vite[cite: 4].

---

## 🛠 Tech Stack
- **Backend:** PHP 8.x, Laravel Framework[cite: 4]
- **Design Patterns:** MVC, Service-Repository Pattern, Dependency Injection (IoC)[cite: 4]
- **Frontend / Templating:** Laravel Blade Components, Bootstrap 5, Vite[cite: 4]
- **Database:** MySQL via Eloquent ORM[cite: 4]
- **Document Engines:** DomPDF (`barryvdh/laravel-dompdf`), Streamed Responses[cite: 4]
- **Authentication:** Laravel Breeze[cite: 4]
- **Testing:** PHPUnit / Laravel TestBench[cite: 4]

---

## 📂 Project Structure Highlights
```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   ├── DashboardController.php
│   │   └── TransactionController.php
│   └── Requests/
│       └── ProfileUpdateRequest.php
├── Models/
│   ├── User.php
│   └── Transaction.php
├── Providers/
│   └── AppServiceProvider.php
├── Repositories/
│   ├── Contracts/
│   │   └── TransactionRepositoryInterface.php
│   └── Eloquent/
│       └── TransactionRepository.php
└── Services/
    └── TransactionService.php

```

---

## ⚙️ Installation & Setup

1. **Clone the repository:**
```bash
git clone [https://github.com/your-username/ledger-plus.git](https://github.com/your-username/ledger-plus.git)
cd ledger-plus

```


2. **Install PHP and Node dependencies:**
```bash
composer install
npm install && npm run build

```


3. **Configure environment:**
```bash
cp .env.example .env
php artisan key:generate

```


*Update your database configuration (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) in `.env`.*
4. **Run migrations and seeders:**
```bash
php artisan migrate --seed

```


5. **Start local development server:**
```bash
php artisan serve

```


Access the application at `http://127.0.0.1:8000`.

---

## 🧪 Testing

Run automated feature and unit tests via PHPUnit:

```bash
php artisan test


