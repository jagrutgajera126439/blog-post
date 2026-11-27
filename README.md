# BlogSphere – Blog Post Management System

BlogSphere is a web-based Blog Post Management System developed using Laravel and MySQL. It helps users create, manage, search, update, and delete blog posts through a simple and user-friendly interface.

## Features

- Dashboard with blog statistics
- Create, view, edit, and delete blog posts
- Search blogs by title and author
- Filter blogs by category and status
- Manage blog categories
- Set blog status as Draft or Published
- Form validation
- Responsive user interface

## Technology Stack

- Frontend: HTML, CSS, Bootstrap
- Backend: PHP, Laravel
- Database: MySQL
- Template Engine: Laravel Blade
- Development Environment: XAMPP
- Code Editor: Visual Studio Code

## Main Modules

1. Dashboard
2. Blog Management
3. Category Management
4. Search and Filter
5. Status Management

## Requirements

- PHP 8.2 or newer (Laravel 12 requirement)
- Composer
- MySQL through XAMPP

## Installation and Setup

1. Clone or download this repository.
2. Open the project folder in Visual Studio Code.
3. Install PHP dependencies:

   `composer install`

4. Create a MySQL database named `blog_post` in phpMyAdmin (or MySQL).
5. Copy `.env.example` to `.env` and set the database host, name, username, and password for your XAMPP MySQL installation.
6. Generate the application key:

   `php artisan key:generate`

7. Run database migrations:

   `php artisan migrate`

8. Start the Laravel development server:

   `php artisan serve`

9. Open `http://127.0.0.1:8000` in your browser.


## Password Reset

On the local XAMPP setup, `MAIL_MAILER=log` writes password reset emails to `storage/logs/laravel.log`. Use the latest reset link from that log after submitting the Forgot password form. To send real emails, configure SMTP settings in `.env`.
## Project Purpose

This project demonstrates Laravel development concepts, database connectivity, CRUD operations, form validation, and dynamic web page development.

## Developed By

**Jagrut Gajera**

Project: Blog Post Management System