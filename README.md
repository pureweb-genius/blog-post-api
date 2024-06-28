# Blog CRUD API with Laravel and Sanctum

This project is a simple Blog CRUD API built with Laravel. It includes user authentication and authorization using Laravel Sanctum, and utilizes PostgreSQL as the database. The project is set up to run using Laravel Sail and Docker.

## Features

- User registration and authentication
- CRUD operations for blog posts
- Authorization to ensure users can only edit and delete their own posts
- Integration with `dummyjson.com` to fetch post data
## Installation

### 1. Clone the repository

```bash
  git clone https://github.com/yourusername/blog-crud-api.git

```
### 2. Install dependencies
```bash
composer install
```
### 3. Copy and update environment file
```bash
cp .env.example .env
```
```bash
php artisan key:generate
```
### 4. Update the .env file to match your database configuration. Here is an example configuration for PostgreSQL:
```bash
DB_CONNECTION=pgsql 

DB_HOST=pgsql

DB_PORT=5432

DB_DATABASE=blog

DB_USERNAME=sail

DB_PASSWORD=password

```

### 5. Start Docker containers
```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
./vendor/bin/sail artisan migrate
```

[![Example Image](https://run.pstmn.io/button.svg)](https://god.gw.postman.com/run-collection/36607896-b16367fb-a099-455b-8e98-243b6d9cd232?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D36607896-b16367fb-a099-455b-8e98-243b6d9cd232%26entityType%3Dcollection%26workspaceId%3D6f02e47c-9fa9-4916-9d4d-8f981a84f0c3)

http://5.180.180.235/
