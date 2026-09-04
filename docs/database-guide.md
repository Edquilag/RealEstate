# Database Guide

This project uses PostgreSQL as its main production-ready database.

## Why PostgreSQL?

PostgreSQL is a strong choice for real-estate applications because it is:

- reliable
- good for structured data
- great for reporting and filtering
- compatible with Laravel
- suitable for production workloads

## Main database concepts

### Tables
Each table represents a type of data.

Examples in this project:

- users
- properties
- inquiries
- conversations
- messages
- broker_profiles
- broker_verification_logs

### Migrations
Migrations are version-controlled database changes.

They let developers create and update tables in a safe, repeatable way.

Example:

```bash
php artisan migrate
```

This runs all pending migrations and updates the database.

### Models
Models map to database tables and make it easier to work with records.

Example:

- User model handles user records
- Property model handles listings
- Inquiry model handles inquiry records

## Relationship examples

This project uses Eloquent relationships, which are a clean way to join data without writing custom SQL.

Examples:

- a property belongs to a broker
- a client can have many inquiries
- a broker can own many properties
- an inquiry belongs to a property and a client

This helps keep the code easier to understand.

## Important tables in this project

### users
Stores login information, roles, and account status.

Fields may include:

- name
- email
- password
- role
- status
- approved_at
- rejected_at

### properties
Stores property listing information.

Fields may include:

- title
- location
- price
- property_type
- description
- broker_id

### inquiries
Stores inquiries sent by clients about properties.

Fields may include:

- property_id
- client_id
- broker_id
- message
- status

### broker_profiles
Stores compliance and registration details for brokers.

This may include:

- company_name
- office_address
- prc_license_number
- prc_license_expiry
- tin
- status

### broker_verification_logs
Stores an audit trail for broker approval or rejection actions.

This is useful for compliance and internal review.

## Local development database

For local work, the app is configured to use PostgreSQL running on your machine or via Docker.

Common setup steps:

```bash
cd backend
cp .env.example .env
php artisan migrate
php artisan test
```

Make sure the database credentials in the .env file match your local PostgreSQL setup.

## Best practices

- never edit migration history by hand
- always create new migrations for schema changes
- keep database field names clear and consistent
- use relationships instead of duplicating data
- add indexes for filtering and search-heavy columns
- avoid putting sensitive data in plain text

## Beginner tip

If a feature is not working, check these first:

1. the migration for the table
2. the model for the record type
3. the controller for the route logic
4. the route definition for the API or page
5. the database records in PostgreSQL

## Useful commands

```bash
php artisan migrate
php artisan migrate:fresh
php artisan db:seed
php artisan tinker
```

These commands help you reset, inspect, and test the database safely while learning.
