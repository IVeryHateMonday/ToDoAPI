# ToDoAPI

REST API for task management built on Laravel 12 with token authentication via Laravel Sanctum.  
The project follows a layered style close to Clean Architecture: Domain, Application, Infrastructure, and HTTP interface.

## Tech Stack

- PHP `^8.2`
- Laravel `^12.0`
- PostgreSQL
- Laravel Sanctum (`^4.0`)
- PHPUnit (`^11.5`)
- Swagger UI (`nextapps/laravel-swagger-ui`)

## Project Structure

```text
app/
  Domain/            # Entities, Value Objects, repository contracts
  Application/       # Use cases (commands + handlers)
  Infrastructure/    # Repository implementations (Eloquent)
  Http/              # Controllers, requests, HTTP validation
  Models/            # Eloquent models
database/
  migrations/
  factories/
routes/
  api.php
tests/
  Unit/
  Feature/
```

## Architecture Notes

- `Domain` contains business rules and must not depend on Laravel or Eloquent.
- `Application` orchestrates use cases through interfaces.
- `Infrastructure` persists data using Eloquent models.
- `Http` layer validates requests and maps them to use-case commands.

## Requirements

- PHP 8.2+
- Composer
- PostgreSQL

Optional:
- Node.js + npm (for frontend assets if needed)

## Installation

```bash
git clone <your-repository-url>
cd ToDoAPI
composer install
cp .env.example .env
php artisan key:generate
```

Set database credentials in `.env`, then run:

```bash
php artisan migrate
php artisan serve
```

API base URL:

`http://localhost:8000/api`

## Environment Configuration

Minimum required variables in `.env`:

- `APP_KEY`
- `APP_ENV`
- `DB_CONNECTION=pgsql`
- `DB_HOST`
- `DB_PORT=5432`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

## Authentication

Authentication uses **Bearer Token** with Sanctum.

### Register

`POST /api/register`

```json
{
  "name": "Alex",
  "email": "alex@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

### Login

`POST /api/login`

```json
{
  "email": "alex@example.com",
  "password": "password"
}
```

Response includes token:

```json
{
  "token": "1|...",
  "user": {
    "id": 1,
    "name": "Alex",
    "email": "alex@example.com"
  }
}
```

## API Endpoints

### Public

- `GET /api/test` - health check
- `POST /api/register` - create account
- `POST /api/login` - create token

### Protected (`auth:sanctum`)

- `POST /api/tasks` - create task

Request:

```json
{
  "title": "Test task"
}
```

Required headers:

```http
Authorization: Bearer <token>
Accept: application/json
```

Success response (`201`):

```json
{
  "title": "Test task",
  "status": "pending"
}
```

## Quick cURL Examples

Register:

```bash
curl -X POST http://localhost:8000/api/register \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"name":"Alex","email":"alex@example.com","password":"password","password_confirmation":"password"}'
```

Login:

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"email":"alex@example.com","password":"password"}'
```

Create task:

```bash
curl -X POST http://localhost:8000/api/tasks \
  -H "Accept: application/json" \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"title":"Test task"}'
```

## Running Tests

```bash
php artisan test
```

or

```bash
composer test
```

## Common Issue

`SQLSTATE[23502]: null value in column "user_id" of relation "tasks"`

This means a task insert was attempted without `user_id`.  
Checklist:

- the route is protected with `auth:sanctum`
- controller reads user from token (`$request->user()->id`)
- `userId` is passed into the use-case command
- repository writes `user_id` into `tasks`

## Roadmap

- `GET /api/tasks` (list only current user's tasks)
- `GET /api/tasks/{id}` (ownership validation)
- `PATCH /api/tasks/{id}` (update status/title)
- `DELETE /api/tasks/{id}`
- Full feature tests for task ownership and authorization
- Full OpenAPI/Swagger coverage for endpoints

## License

MIT
