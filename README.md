# Commercial Real Estate App

This repository contains a Laravel backend and front-end project for a real-estate platform focused on property listings, broker workflows, client inquiries, and admin approvals.

## Project structure

- backend/ — Laravel application and API
- frontend/ — front-end application
- docs/ — beginner-friendly project documentation
- .github/workflows/ — CI pipeline configuration

## Documentation

For new developers, start with these files:

- [docs/backend-overview.md](docs/backend-overview.md)
- [docs/database-guide.md](docs/database-guide.md)
- [docs/ci-cd-pipeline.md](docs/ci-cd-pipeline.md)

## Quick start

### 1. Clone the repository

```bash
git clone <your-repository-url>
cd commercial-real-estate
```

### 2. Set up the backend

```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan test
php artisan serve
```

### 3. Set up the frontend

```bash
cd ../frontend
npm install
npm run dev
```

## Backend environment notes

Before using the app, confirm your environment values are correct in backend/.env:

- DB_CONNECTION
- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD
- APP_KEY
- APP_URL

For production, make sure:

- APP_ENV=production
- APP_DEBUG=false
- APP_URL points to the live domain
- database credentials are secured
- HTTPS is enabled

## Development workflow

Typical workflow for contributors:

```bash
cd backend
php artisan migrate
php artisan test
php artisan serve
```

Then work on features and open a pull request once the CI checks pass.

## CI/CD

This project uses GitHub Actions for continuous integration.

The pipeline installs dependencies, creates a PostgreSQL test database, runs migrations, builds frontend assets, and executes the test suite.

See [docs/ci-cd-pipeline.md](docs/ci-cd-pipeline.md) for a beginner-friendly explanation.

## Database

The project uses PostgreSQL and Laravel migrations to manage the schema.

See [docs/database-guide.md](docs/database-guide.md) for a simple explanation of tables, relationships, and migration workflow.

## Roles in the application

- Admin — manages approvals and oversight
- Broker — manages properties and responds to inquiries
- Client — browses listings and submits inquiries

## Common commands

```bash
cd backend
php artisan route:list
php artisan migrate
php artisan migrate:fresh
php artisan test
php artisan tinker
```

## Notes for new developers

Start by understanding the flow:

1. route is called
2. controller handles the request
3. model reads or writes the database
4. response is returned to the client

This is the basic architecture used throughout the Laravel backend.

## Contributing

Before submitting changes:

- run the test suite
- keep migrations safe and versioned
- avoid hardcoding secrets
- document major changes
- keep code readable for beginner developers

## License

This project is for internal or project-based use unless otherwise specified by the repository owner.
