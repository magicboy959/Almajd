# Laravel API and Filament boundary

Create the production API here with Laravel 11, Sanctum, MySQL, Filament, queues and an S3-compatible private disk. This workspace currently contains the Next.js application and its local development abstraction so the public experience can be reviewed without external credentials.

## Required implementation order

1. `composer create-project laravel/laravel backend` and install `laravel/sanctum`, `filament/filament`, a roles/permissions package, and an S3 filesystem adapter.
2. Add migrations and models for the tables listed in `../docs/ARCHITECTURE.md`.
3. Add policies for customer-owned requests, private documents, quotations and invoices.
4. Add Form Requests, API Resources and rate-limited controllers matching the documented API contract.
5. Add queued notifications, immutable status history observers, audit events, signed private downloads and the virus-scan adapter interface.
6. Build Filament resources and dashboards for staff roles: Super Administrator, Manager, Case Officer, Accountant and Content Editor.
7. Add feature tests for authorization, request reference generation, status history, private documents and localization.

No production credential, government integration or public document URL belongs in this repository.
