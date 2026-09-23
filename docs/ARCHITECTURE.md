# Qemmat Al Majd architecture

## Applications

- `frontend/` is represented by the Next.js App Router in this initial workspace. Public pages use localized routes under `/en` and `/ar`, with server-rendered page boundaries and small client components for search, tracking and request submission.
- `backend/` is reserved for the Laravel REST API and Filament administration application. The current local request API is intentionally a development abstraction at `app/api/requests/route.ts`; replace it with the Laravel endpoint before production.

## Laravel API contract

The production API should expose:

- `POST /api/v1/auth/register`, `POST /api/v1/auth/login`, `POST /api/v1/auth/logout`
- `GET /api/v1/services`, `GET /api/v1/services/{slug}`
- `POST /api/v1/service-requests` (Sanctum protected for customers, CAPTCHA-ready for guests)
- `GET /api/v1/service-requests/{reference}` with mobile/email authorization
- `POST /api/v1/service-requests/{request}/documents` using private S3-compatible storage
- `GET /api/v1/service-requests/{request}/documents/{document}/download` returning a short-lived signed URL

## Core tables

`users`, `roles`, `permissions`, `customers`, `staff_profiles`, `service_categories`, `services`, `service_requirements`, `service_faqs`, `service_requests`, `request_status_histories`, `request_documents`, `request_messages`, `quotations`, `quotation_items`, `invoices`, `invoice_items`, `payments`, `contact_enquiries`, `team_members`, `testimonials`, `faqs`, `pages`, `settings`, `audit_logs`.

Request status transitions must append an immutable `request_status_histories` row with actor, previous status, new status, customer-visible note, internal note and timestamp. Sensitive documents remain private, use randomized storage names, an allowlist and size limits, virus-scan adapter hooks, authorization on every download, and document-access audit events.

## Production configuration

The Laravel application should provide `.env.example` placeholders for MySQL, Sanctum, mail queue, S3-compatible storage, CAPTCHA, WhatsApp number, antivirus adapter and retention period. Public government names are descriptive only; there is no implied government affiliation or API integration.
