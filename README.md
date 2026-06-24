# Invoice Management System

A simple modular Invoice Management System built with Laravel 12 and Laravel Modules.

## Features

* Customer Management
* Invoice Creation
* Dynamic Invoice Items
* Server-side Calculations
* PDF Invoice Preview
* Modular Architecture
* Repository Pattern
* Service Layer
* DTOs
* API Resources
* Database Seeders

## Tech Stack

* Laravel 12
* Laravel Modules v12
* MySQL
* baidouabdellah/laravel-arpdf

## Architecture

The project follows a modular architecture using:

* Modules
* Service Layer
* Repository Pattern
* DTOs
* API Resources

### Modules

* Customers
* Invoices
* Auth

## Installation

Clone the repository:

```bash
git clone <repository-url>
cd invoice-management-modular
```

Install dependencies:

```bash
composer install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure your database credentials inside the `.env` file.

Create the database:

```sql
CREATE DATABASE invoice_management
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Run migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

Clear caches (recommended):

```bash
php artisan optimize:clear
```

Start the development server:

```bash
php artisan serve
```

## Default Admin Account

After running the seeders:

```bash
php artisan migrate:fresh --seed
```

Use the following credentials:

| Field    | Value                                         |
| -------- | --------------------------------------------- |
| Email    | admin@admin.com                               |
| Password | password                                      |

> Update the credentials above if your seeder uses different values.

## Seeded Data

The project includes sample seeded data for testing purposes.

After running:

```bash
php artisan migrate:fresh --seed
```

You will have:

* Sample Customers
* Default Admin User
* Sample Invoice Data (if available)

## Authentication

Login endpoint:

```http
POST /api/v1/auth/login
```

Use the returned token in subsequent requests:

```http
Authorization: Bearer {token}
```

## API Endpoints

### Customers

#### List Customers

```http
GET /api/v1/customers
```

#### Create Customer

```http
POST /api/v1/customers
```

#### Customer Select Endpoint

```http
GET /api/v1/customers/select
```

---

### Invoices

#### List Invoices

```http
GET /api/v1/invoices
```

#### Get Invoice

```http
GET /api/v1/invoices/{id}
```

#### Create Invoice

```http
POST /api/v1/invoices
```

#### Invoice PDF Preview

```http
GET /api/v1/invoices/{id}/pdf
```

## Invoice Payload Example

```json
{
  "customer_id": 1,
  "invoice_date": "2026-06-23",
  "shipping_amount": 50,
  "tax": 25,
  "discount": 10,
  "notes": "Test invoice",
  "items": [
    {
      "item_name": "Laptop",
      "quantity": 2,
      "unit_price": 1000, 
    }
  ]
}
```

## Calculations

All invoice calculations are validated and recalculated server-side before persistence.

Calculated values include:

* Subtotal
* Discount Amount
* Tax Amount
* Shipping Amount
* Total Amount

This ensures that invoice totals cannot be manipulated from the client side.

## PDF Preview

The system provides a simple Arabic RTL invoice PDF preview generated using:

* baidouabdellah/laravel-arpdf

Example:

```http
GET /api/v1/invoices/1/pdf
```

## Project Structure

```text
Modules/
├── Auth/
├── Customers/
│   ├── Http/
│   ├── Services/
│   ├── Repositories/
│   ├── DTOs/
│   └── Resources/
│
├── Invoices/
│   ├── Http/
│   ├── Services/
│   ├── Repositories/
│   ├── DTOs/
│   ├── Resources/
│   └── PDF/
```

## Development Notes

This project was built with a focus on:

* Clean Architecture
* Modular Design
* Separation of Concerns
* Maintainability
* Scalability
* Testability

## Notes

* All invoice calculations are performed server-side.
* Inventory management is out of scope.
* Payments and reporting are out of scope.
* The application uses a modular architecture to improve maintainability and separation of concerns.

## Postman Collection

A Postman collection is included to make testing the API easier.

Import the collection file:

```text
postman/Invoice Management.postman_collection.json
```

The collection includes:

* Authentication
* Customers Endpoints
* Invoices Endpoints
* PDF Preview Endpoint

After logging in, set the returned token in the Authorization header:

```http
Authorization: Bearer {token}
```
postman/
├── Invoices API ( Modules ).postman_collection.json

{
  "base_url": "http://localhost:8000",
  "token": ""
}
