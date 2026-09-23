# Deployment notes

## Frontend

Build with `npm run build` and run with `npm start`. Set `NEXT_PUBLIC_API_URL` to the deployed Laravel API. Put the site behind HTTPS and configure the reverse proxy to serve the Next.js process.

## Backend

Run Laravel migrations and seeders during release, configure a database-backed queue worker, schedule document-retention cleanup, and keep S3 documents on a private bucket. Use a separate database backup schedule and test recovery regularly.

## Security checklist

- Force HTTPS and secure, HttpOnly, SameSite cookies.
- Configure trusted origins for Sanctum and rate limits for login, tracking and request submission.
- Run antivirus scanning before documents become available to staff.
- Serve only short-lived signed document URLs after policy authorization.
- Keep government disclaimer visible in the footer and disclaimer page.
- Never log document contents, passwords, OTPs or full identification numbers.
