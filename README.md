# Laravel API Starter Kit — Best Practices

This repository serves as a **Laravel API Starter Kit** for building modern, production-ready **API-only Laravel applications**.  
It provides a strong, opinionated foundation for **clean, maintainable, type-safe, and secure API-driven systems**.

The goal is to enforce **structure consistency**, **shared design patterns**, and **high-quality standards**, leveraging bleeding-edge tools and modern PHP practices.

This starter kit is inspired by [Nuno Maduro’s Laravel Starter Kit](https://github.com/nunomaduro/laravel-starter-kit).

---

## Project Overview

This starter kit defines a clear architecture and enforces best practices specifically for API development:

- **Consistent JSON responses** for success, errors, and validation.
- Maximum type safety and robust code through **PHPStan (max level)**.
- Automated refactoring and modernization via **Rector**.
- Automatic code formatting with **Laravel Pint**.
- Full test coverage and behavior-driven development using **PestPHP**.
- **OpenAPI (Swagger) documentation** generated via `darkaonline/l5-swagger` with annotations inside the `app` folder.
- Secure, resilient, and scalable architecture tailored for APIs.

Developers should carefully read this document before starting a new API project to understand the conventions and patterns in use.

---

## App Folder Structure

The `app` directory contains the main API logic. Each folder serves a specific role:

- **Concerns** — Reusable traits for models, services, or other classes.
- **Contracts** — Interface definitions for services, repositories, and integrations.
- **Dtos** — Data Transfer Objects for API input/output validation and transformation.
- **Enums** — Domain constants, statuses, or configuration options.
- **Events** — Domain and application events supporting event-driven architecture.
- **Exceptions** — Custom exception classes for API-specific errors.
- **Exports** — Logic for exporting data (CSV, Excel, etc.).
- **Http** — Controllers, Middleware, Resources, and **API Responses**.
- **Jobs** — Queueable background tasks for asynchronous API operations.
- **Listeners** — Event listeners reacting to application events.
- **Models** — Eloquent ORM models representing API data structures.
- **Notifications** — Database or API-driven notifications.
- **Policies** — Authorization logic for API resources.
- **Providers** — Service providers bootstrapping API services.
- **Services** — Core business logic encapsulated in domain services.
- **OpenApi** — API documentation annotations used by `darkaonline/l5-swagger` to generate OpenAPI/Swagger docs automatically.

---

## API Layer and Responses

- `app/Http/Responses/ApiResponse.php` standardizes all JSON responses.
- Controllers and resources rely on this class to maintain **consistent and professional API responses**.
- Includes structured success, error, and validation outputs.

---

## OpenAPI Documentation

- All API endpoints are annotated inside the `app` folder using **OpenAPI annotations**.
- `darkaonline/l5-swagger` generates interactive Swagger documentation automatically.
- This ensures API documentation is always **up-to-date and aligned with your code**.

---

## Bootstrap Configuration (`bootstrap/app.php`)

- Centralizes API configuration and routes.
- Ensures all requests return JSON consistently.
- Handles common exception types with standardized API responses.
- Provides unified error structures in both development and production.

---

## AppServiceProvider

Located at `app/Providers/AppServiceProvider.php`.

- Prevents destructive database commands in production.
- Enforces strict model behavior to catch API-related mistakes early.
- Defines morph maps for polymorphic relationships in API resources.

---

## Notifications Foundation

- `app/Notifications/DatabaseNotification.php` serves as a **base for all API and database notifications**, centralizing shared logic for maintainability.

---

## Code Quality and Developer Tooling

- **PHPStan (max level)** — Ensures strict type safety and reliable API code.
- **Rector** — Automates refactoring and modernization of PHP code.
- **Laravel Pint** — Automatic formatting of PHP code.
- **PestPHP** — Lightweight and expressive testing for APIs with full coverage.

These tools ensure **bleeding-edge, type-safe, robust, and secure API code**.

---

## Composer Scripts

Defined in `composer.json` for development automation:

- **lint** — Runs Rector and Pint for code refactoring and formatting.
- **test** — Runs PHPStan and PestPHP for static analysis and API testing.

**Workflow before committing code:**

1. `composer list` — Verify available commands.
2. `composer lint` — Automatically format and refactor code.
3. `composer test` — Run static analysis and API tests to catch issues early.

---

## Design Principles

- **Separation of Concerns** — Each layer has a focused responsibility.
- **SOLID Principles** — Ensures flexible and maintainable API architecture.
- **Convention Over Configuration** — Predictable folder and class structures reduce overhead.
- **Testability** — Clear abstractions make API testing straightforward.
- **Consistency & Predictability** — Centralized response handling and strict models ensure API stability.
- **Documented** — OpenAPI annotations ensure **live, up-to-date API docs**.

---

## Development Workflow

1. Clone the repository.
2. Install dependencies via Composer.
3. Copy `.env.example` and configure environment variables.
4. Generate the application key.
5. Run static analysis, linting, formatting, API tests, and generate Swagger docs before commits.

This ensures **all developers maintain the same high standards** for API development.

---

## Contributor Guidelines

Follow the established folder structure, coding standards, and naming conventions.  
Consistency is mandatory for scalable, maintainable API projects.

---

## Summary

This Laravel API Starter Kit provides a **standardized, production-ready foundation** for modern APIs.  
It promotes **clean architecture, type safety, consistent responses, secure development, robust testing, and live documentation**.

**“Build APIs fast. Scale clean. Maintain with confidence.”**

Inspired by [Nuno Maduro’s Laravel Starter Kit](https://github.com/nunomaduro/laravel-starter-kit).
