<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

---

# Product Data Importer UI

## Description

Product Data Importer UI is a Laravel-based web application designed to fetch and display products from the DummyJSON API. It features scheduled data fetching, robust error handling, user authentication, and an interactive UI built with Vue.js and Inertia.js.

## Requirements

- PHP: ^8.1
- Laravel: ^10.10
- Node.js and NPM (for frontend assets)

## Setup Instructions

### Environment Setup

1. Clone the repository.
2. Run `composer install` to install PHP dependencies.
3. Copy `.env.example` to `.env` and configure your environment settings, especially the database connection.
4. Run `php artisan key:generate` to generate an application key.

### Database Migration

1. Set up your database and ensure your `.env` file has the correct database credentials.
2. Run `php artisan migrate` to create the necessary tables in your database.

### Command Scheduling

- The application is set to fetch data from DummyJSON API every 2 hours.
- Add a cron job on your server to run Laravel's scheduler:
  ```
  * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
  ```

### Running the Application

1. Run `npm install` and `npm run dev` to compile frontend assets.
2. Use `php artisan serve` to start the Laravel development server.

## Assumptions and Additional Libraries

- **GuzzleHTTP**: Used for making HTTP requests to the DummyJSON API.
- **Inertia.js**: Utilized for building the single-page application experience.
- **Vue.js**: Frontend framework.

## Compatibility

- Compatible with PHP version ^8.1 and Laravel version ^10.10.
- Ensure your server meets the specified PHP and Laravel requirements.
