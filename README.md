# Qemmat Al Majd Business Services

Bilingual public website foundation for Qemmat Al Majd Business Services, built with Next.js App Router, TypeScript and a documented Laravel/Sanctum/Filament API boundary.

## Run locally

```bash
npm install
npm run dev
```

Open `http://localhost:3000/en` or `http://localhost:3000/ar`.

## Current routes

- `/en`, `/ar`: bilingual public home
- `/en/services`, `/ar/services`: searchable service directory
- `/en/request`, `/ar/request`: three-step request workflow with local reference generation
- `/api/requests`: development-only validation and reference endpoint

## Backend handoff

See [docs/ARCHITECTURE.md](docs/ARCHITECTURE.md). The production backend should be a separate Laravel application with MySQL, Sanctum, Filament, queues and private S3-compatible document storage. The local API route is deliberately small so the frontend can be exercised before provider credentials exist.

## Environment

The current public prototype has no secrets. Production configuration should add `NEXT_PUBLIC_API_URL`, `NEXT_PUBLIC_WHATSAPP_NUMBER`, and the Laravel variables for database, Sanctum, mail, queue, S3, CAPTCHA, virus scanning and retention. Never commit credentials.
