# Backend Overview

This project uses a Laravel backend to manage real-estate data, user accounts, broker approvals, and customer inquiries.

## What the backend does

The backend is the "brain" of the application. It handles:

- user login and registration
- role-based access for admin, broker, and client users
- property listings and property management
- inquiry submissions from clients
- conversations and messages between clients and brokers
- broker approval and compliance checks
- API routes for frontend or external apps

## Main folders

Inside the backend folder, the most important folders are:

- app/
  - contains the real application logic
  - includes controllers, models, policies, middleware, and service code
- routes/
  - defines API and web endpoints
- database/migrations/
  - defines database schema changes over time
- database/seeders/
  - populates sample data
- tests/
  - contains automated checks for app behavior
- config/
  - holds Laravel settings such as database, session, and auth
- resources/
  - holds views and frontend assets for Laravel pages

## Important Laravel concepts

### Models
Models represent database tables.

Examples:

- User
- Property
- Inquiry
- BrokerProfile

These classes help you read and write data without writing raw SQL.

### Controllers
Controllers handle HTTP requests and call the logic needed for that request.

Example:

- the InquiryController creates inquiries
- the UserApprovalController handles broker approval actions

### Routes
Routes define what URL should call which controller method.

Example:

- /dashboard
- /admin/approvals
- /api/v1/properties

### Middleware
Middleware runs before a request is processed.

This project uses middleware to:

- check if the user is logged in
- enforce user roles such as admin, broker, or client
- block unapproved brokers

### Policies
Policies decide whether a user is allowed to do something.

Example:

- A broker can only update inquiries for their own properties
- A client can only view their own inquiry records

## User roles in this project

### Admin
Admin users manage approval flows and system oversight.

### Broker
Broker users can:

- add or edit properties
- view inquiries tied to their listings
- respond to clients

Broker accounts must be approved before they can fully operate.

### Client
Client users can:

- browse properties
- submit inquiries
- view their own inquiries and conversations

## Beginner tip

When you are learning the project, start from the routes and then follow the controller and model it calls.

A simple flow is:

1. browser or API calls a URL
2. route matches the URL
3. controller runs
4. model reads/writes database
5. response is sent back

That is the basic pattern used throughout Laravel.

## Good next steps

If you are new to this project, try these in order:

1. read routes/web.php and routes/api.php
2. open one controller, such as InquiryController or PropertyController
3. look at the related model like Inquiry or Property
4. run the tests to see expected behaviors
5. make small changes and test often

## Common command examples

```bash
cd backend
php artisan route:list
php artisan migrate
php artisan test
php artisan serve
```

These commands help you inspect the app and confirm it is working correctly.
