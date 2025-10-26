# Laravel Task Management API — Best Practices Example

This repository serves as a **reference/base project** demonstrating a modern, production-ready **API-only Laravel application**.  
It is built with **clean architecture, type safety, and robust API design** to act as an example for developers.

The goal is to showcase **best practices for building maintainable, secure, and testable APIs** using bleeding-edge PHP tools and modern Laravel conventions.

This project is inspired by [Nuno Maduro’s Laravel Starter Kit](https://github.com/nunomaduro/laravel-starter-kit).

---

## Project Overview

This project implements a **Task Management API** following best practices for API development:

- **Consistent JSON responses** for success, errors, and validation.
- Maximum type safety with **PHPStan (max level)**.
- Automated refactoring with **Rector**.
- Automatic code formatting via **Laravel Pint**.
- Full test coverage using **PestPHP**.
- **OpenAPI/Swagger documentation** generated via `darkaonline/l5-swagger` with annotations in the `app` folder.
- Secure, resilient, and scalable architecture designed specifically for APIs.
- Example of structured domain logic with **Dtos, Services, Events, and Repositories**.

This project is meant as a **learning and reference tool**, not a full commercial application.

---

## App Folder Structure

The `app` directory contains the main API logic. Key folders include:

- **Concerns** — Reusable traits.
- **Contracts** — Interface definitions for services and repositories.
- **Dtos** — Data Transfer Objects for request/response typing and validation.
- **Enums** — Domain constants, statuses, or configuration options.
- **Events** — Domain/application events for event-driven architecture.
- **Exceptions** — Custom exception classes for API errors.
- **Exports** — Logic for exporting data (CSV, Excel, etc.).
- **Http** — Controllers, Middleware, Resources, and **API Responses**.
- **Jobs** — Queueable background tasks for asynchronous operations.
- **Listeners** — Event listeners reacting to domain events.
- **Models** — Eloquent models representing the API’s data.
- **Notifications** — Database or API-driven notifications.
- **Policies** — Authorization logic for API resources.
- **Providers** — Service providers bootstrapping API services.
- **Services** — Core business logic encapsulated in domain services.
- **OpenApi** — Swagger/OpenAPI annotations for automatic documentation generation.

---

## API Layer and Responses

- `app/Http/Responses/ApiResponse.php` standardizes all JSON responses.
- Controllers and resources use this class to ensure **consistent and professional API responses**.
- Includes structured success, error, and validation responses.

---

## OpenAPI Documentation

- All API endpoints are annotated inside the `app` folder using OpenAPI annotations.
- `darkaonline/l5-swagger` generates **interactive Swagger documentation** automatically.
- This ensures API documentation is always **up-to-date and aligned with code**.

---

## Bootstrap Configuration (`bootstrap/app.php`)

- Centralizes API configuration and routes.
- Ensures all requests return JSON consistently.
- Handles common exceptions with standardized responses.
- Provides unified error structures in both development and production.

---

## AppServiceProvider

Located at `app/Providers/AppServiceProvider.php`.

- Prevents destructive database commands in production.
- Enforces strict model behavior to catch API-related mistakes early.
- Defines morph maps for polymorphic relationships in API resources.

---

## Notifications Foundation

- `app/Notifications/DatabaseNotification.php` serves as a **base for all API/database notifications**, centralizing shared logic.

---

## Code Quality and Developer Tooling

- **PHPStan (max level)** — Strict type safety and reliable API code.
- **Rector** — Automated refactoring and modernization.
- **Laravel Pint** — Automatic PHP formatting.
- **PestPHP** — Expressive API tests with full coverage.

These tools ensure **bleeding-edge, type-safe, robust, and secure API code**.

---

## Composer Scripts

Defined in `composer.json` for development automation:

- **lint** — Runs Rector and Pint for code refactoring and formatting.
- **test** — Runs PHPStan and PestPHP for static analysis and API testing.

**Workflow before committing code:**

1. `composer list` — Verify available commands.
2. `composer lint` — Format and refactor code.
3. `composer test` — Run static analysis and API tests.

---

## Design Principles

- **Separation of Concerns** — Each layer has a focused responsibility.
- **SOLID Principles** — Flexible and maintainable API architecture.
- **Convention Over Configuration** — Predictable structure reduces overhead.
- **Testability** — Clear abstractions make API testing straightforward.
- **Consistency & Predictability** — Centralized responses and strict models.
- **Documented** — OpenAPI annotations ensure **live, up-to-date API docs**.

---

## Development Workflow

1. Clone the repository.
2. Install dependencies via Composer.
3. Copy `.env.example` and configure environment variables.
4. Generate the application key.
5. Run static analysis, linting, formatting, API tests, and generate Swagger docs before commits.

This ensures **all developers maintain high standards** for API development.

---

## Contributor Guidelines

Follow the established folder structure, coding standards, and naming conventions.  
Consistency is mandatory for scalable, maintainable API projects.

---

## Summary

This **Task Management API** serves as a **reference project** demonstrating modern API development with Laravel.  
It promotes **clean architecture, type safety, consistent responses, secure development, robust testing, and live documentation**.

**“Build APIs fast. Scale clean. Maintain with confidence.”**

Inspired by [Nuno Maduro’s Laravel Starter Kit](https://github.com/nunomaduro/laravel-starter-kit).
