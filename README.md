# Laravel API Starter Kit — Sadeem Informatique

This repository serves as the official **Laravel API Starter Kit** for all **Sadeem Informatique** projects.  
It provides a strong, opinionated foundation for building clean, maintainable, and scalable API-driven Laravel applications.

The goal is to ensure **structure consistency**, **shared design patterns**, and **high-quality standards** across all backend projects.

---

## Project Overview

This starter kit defines a clear architecture and enforces best practices through a structured application design, standardized API responses, and automated code quality tools.

Developers should carefully read this document before starting any new Laravel API project to fully understand the conventions and patterns in use.

---

## App Folder Structure

The `app` directory contains the main application logic. Each folder serves a specific role in the architecture.

- **Concerns** — Reusable traits shared across models, services, or other classes.
- **Contracts** — Interface definitions for abstractions such as services, repositories, and integrations.
- **Enums** — Enumerations used for defining domain constants, statuses, or configuration options.
- **Events** — Application and domain events supporting an event-driven architecture.
- **Exceptions** — Custom exception classes for domain or infrastructure errors.
- **Exports** — Logic responsible for data exporting such as Excel or CSV files.
- **Http** — Contains all HTTP-related logic including Controllers, Middleware, Resources, and Responses.
- **Jobs** — Queueable background jobs or asynchronous tasks.
- **Listeners** — Event listeners that react to specific application events.
- **Models** — Eloquent ORM models that represent the application’s data.
- **Notifications** — Notification classes (email, database, or other channels).
- **Policies** — Authorization logic and rules for application models.
- **Providers** — Service providers used to bootstrap and register services within the application.
- **Services** — Business logic and domain services that encapsulate core functionality.

---

## Bootstrap Configuration (bootstrap/app.php)

The `bootstrap/app.php` file centralizes the application’s core configuration using Laravel’s `Application::configure()` method.

### Key Responsibilities:
- Defines the routes for API, console commands, and health checks.
- Configures exception handling for API-based responses.
- Ensures that JSON is always returned for API requests.
- Handles common exception types with standardized API responses.
- Provides unified and consistent error structures in both development and production modes.

This configuration ensures that all API endpoints return a consistent and predictable JSON structure across the project.

---

## AppServiceProvider

Located at `app/Providers/AppServiceProvider.php`, this provider contains global configurations that improve safety, consistency, and behavior across environments.

### Main Configurations:
- **Prevents destructive database commands in production.**
- **Enforces strict model behavior to catch common mistakes early.**
- **Defines a morph map for polymorphic relationships** to ensure consistency and clarity when using Laravel’s morph relations.

These configurations help maintain high code quality and protect production data integrity.

---

## HTTP Layer and API Responses

Inside the `app/Http` folder, the **Responses** directory contains the `ApiResponse` class, which standardizes all JSON responses returned from the API.

This provides a consistent structure for success, error, and validation responses, ensuring that all Laravel API projects built from this starter kit behave uniformly.

Controllers and resources leverage this class to maintain predictable and professional API behavior.

---

## Notifications Foundation

Within the `app/Notifications` folder, the `DatabaseNotification` abstract class serves as the **base class for all database notifications**.

It centralizes shared logic and behavior for notifications, ensuring consistency and easier maintainability when extending notification types across the project.

---

## Code Quality and Developer Tooling

The root folder contains several configuration files to ensure code consistency and quality across the entire project.

- **pint.json** — Defines Laravel Pint configuration for automatic code formatting.
- **rector.php** — Contains Rector configuration for automated refactoring and modernization of PHP code.
- **phpstan.neon** — Configuration file for PHPStan static analysis, ensuring high-level code reliability and correctness.

---

## Composer Scripts

The `composer.json` file defines several useful scripts to automate development workflows and maintain code quality.

- **lint** — Runs Rector and Pint to automatically refactor and format code.
- **test** — Clears configuration cache and runs PHPStan for static code analysis.

These scripts should be executed before each commit to ensure that code adheres to Sadeem Informatique’s standards.

Before committing your changes, always run:

1. `composer list` — to verify available commands.
2. `composer lint` — to automatically format and refactor code.
3. `composer test` — to run static analysis and catch potential issues.

---

## Design Principles

This starter kit is built upon the following core architectural principles:

- **Separation of Concerns** — Each layer of the application has a single, focused responsibility.
- **SOLID Principles** — Strong adherence to object-oriented design principles ensures flexibility and maintainability.
- **Convention Over Configuration** — Predictable and consistent folder and class structures reduce cognitive overhead.
- **Testability** — Clear abstractions and boundaries make the system easy to test.
- **Consistency and Predictability** — Centralized response handling, strict models, and enforced morph maps ensure stability.

These principles guide the overall design and help maintain long-term project health.

---

## Development Workflow

1. Clone the repository from the organization’s GitHub.
2. Install dependencies using Composer.
3. Copy the example environment file and configure it.
4. Generate the application key.
5. Run static analysis and code formatting tools before each commit.

This workflow ensures that all developers on the team maintain the same standards and coding practices.

---

## Contributor Guidelines

This starter kit is maintained by **Sadeem Informatique’s Laravel development team**.  
Contributors must follow the established structure, coding standards, and naming conventions defined in this README.  
Consistency across all projects is mandatory for scalability and maintainability.

---

## Summary

The **Sadeem Informatique Laravel API Starter Kit** provides a standardized, production-ready foundation for building modern Laravel APIs.  
It promotes clean architecture, consistent design patterns, and reliable development practices.

By following these guidelines, developers can build scalable, maintainable, and high-quality backend systems faster and more efficiently.

**“Build fast. Scale clean. Maintain with confidence.”**
