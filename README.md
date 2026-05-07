# Task Management System

## Overview

This is a simple Task Management System built using **Laravel** and **MySQL**. The application allows authenticated users to create, view, update, and delete their own tasks.

## Features

- ✅ User Registration & Login
- ✅ Task CRUD Operations
- ✅ Task Ownership Management
- ✅ Authentication & Authorization
- ✅ Form Validation
- ✅ MySQL Database Integration
- ✅ Responsive UI

## Tech Stack

| Technology       | Details          |
|------------------|------------------|
| **Framework**    | Laravel          |
| **Database**     | MySQL            |
| **Frontend**     | Blade / Bootstrap|
| **Authentication** | Laravel Breeze |

## Installation & Setup

### 1. Clone Repository

```bash
git clone <your-github-repository-link>
cd task-management-system
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Create Environment File

```bash
cp .env.example .env
```

### 4. Configure Database

Update `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Install Laravel Breeze Authentication

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```

### 8. Start Development Server

```bash
php artisan serve
```

**Application URL:** [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Database Structure

### `users` table

| Column       | Description         |
|--------------|---------------------|
| `id`         | Primary Key         |
| `name`       | User's name         |
| `email`      | User's email        |
| `password`   | Hashed password     |
| `created_at` | Timestamp           |
| `updated_at` | Timestamp           |

### `tasks` table

| Column        | Description              |
|---------------|--------------------------|
| `id`          | Primary Key              |
| `title`       | Task title               |
| `description` | Task description         |
| `status`      | Pending / Completed      |
| `due_date`    | Task due date            |
| `user_id`     | Foreign key (users)      |
| `created_at`  | Timestamp                |
| `updated_at`  | Timestamp                |

## Task Features

Each authenticated user can:

- 📝 Create tasks
- 👀 View own tasks
- ✏️ Edit tasks
- 🗑️ Delete tasks

### Validation Rules

- Title is required
- Due date must be valid
- Status should be `Pending` or `Completed`

## Authentication

- Only logged-in users can access task routes.
- Users can only manage their own tasks.
- Unauthorized access is restricted.

## Optional Features

- 🔄 Soft Deletes
- 🔍 Task Filtering
- 🔎 Search Functionality
- 📄 Pagination

## Useful Laravel Commands

```bash
# Create Model with Migration
php artisan make:model Task -m

# Create Controller
php artisan make:controller TaskController --resource

# Run Migration
php artisan migrate

# Rollback Migration
php artisan migrate:rollback
```

## API / Routes Example

```php
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});
```

## Author

**Adil Nabhan**
- Backend Developer
- Django & REST API Developer
- React & Full Stack Developer
