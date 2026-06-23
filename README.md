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

Modules:

* Customers
* Invoices

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

Configure database credentials in `.env`.

Run migrations:

```bash
php artisan migrate
```

Start the development server:

```bash
php artisan serve
```

## Database

Create a MySQL database before running migrations:

```sql
CREATE DATABASE invoice_management
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
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

### Invoices

#### Create Invoice

```http
POST /api/v1/invoices
```

#### Get Invoice

```http
GET /api/v1/invoices/{id}
```

#### List Invoices

```http
GET /api/v1/invoices
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
  "notes": "Test invoice",
  "items": [
    {
      "item_name": "Laptop",
      "quantity": 2,
      "unit_price": 1000,
      "discount_amount": 100,
      "tax_amount": 50
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

## PDF Preview

The system provides a simple Arabic RTL invoice PDF preview generated using:

* baidouabdellah/laravel-arpdf

Example:

```http
GET /api/v1/invoices/1/pdf
```

## Notes

* Authentication is intentionally omitted as requested in the assessment.
* Inventory management is out of scope.
* Payments and reporting are out of scope.
* Focus was placed on clean architecture, server-side validation, invoice calculations, and PDF generation.
