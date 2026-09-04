# CI/CD Pipeline Guide

This project uses GitHub Actions to automatically test the application when code is pushed or a pull request is opened.

## What CI means

CI stands for Continuous Integration.

It means the project automatically checks whether code still works before it is merged.

In this project, the pipeline does the following:

- checks out the code
- installs PHP dependencies
- installs Node dependencies
- sets up a PostgreSQL database
- runs Laravel migrations
- builds frontend assets
- runs the test suite

## Current pipeline flow

The GitHub Actions workflow file is located here:

- .github/workflows/laravel.yml

It runs on:

- pushes to main
- pull requests targeting main

## Pipeline steps explained

### 1. Checkout repository
This fetches the project source code from GitHub.

### 2. Setup PHP
The app uses PHP 8.3, which matches the Laravel backend requirements.

### 3. Setup Node
The frontend uses Node and NPM, so the workflow installs the required JavaScript dependencies.

### 4. Install Composer dependencies
Laravel packages are installed from Composer.

### 5. Install Node dependencies
This installs the frontend packages needed for Vite and asset building.

### 6. Create test environment
The workflow builds a temporary .env file for testing. This makes sure the app runs in a clean and consistent environment.

### 7. Build frontend assets
This compiles the frontend before tests complete.

### 8. Run database migrations
Laravel applies the schema to the testing database.

### 9. Run tests
The final step runs the full automated suite using Laravel Pest.

## Why this matters

CI helps catch problems early, such as:

- broken routes
- migration issues
- incorrect rule validation
- failed auth flows
- unsupported role behavior
- frontend build breaks

## What CD would mean here

CD stands for Continuous Deployment.

This project is not yet fully set up for automatic deployment to production, but the general idea would be:

1. code is pushed to GitHub
2. CI checks pass
3. deployment job pushes the app to a hosting provider
4. app runs with production environment variables
5. database migrations run in production

## Good deployment checklist

Before production deployment, confirm:

- APP_KEY is set
- APP_ENV is production
- APP_URL is correct
- database credentials are secure
- HTTPS is enforced
- session cookies are secure
- admin and role protections are working
- no exposed private endpoints remain

## Beginner tip

Treat CI like a quality gate. If it fails, your code is not ready yet.

The goal is not to make the pipeline complicated. It is to make sure the project is always tested in a repeatable environment.

## Useful command for local testing

```bash
cd backend
php artisan test
```

This mirrors the same validation behavior used in CI.
