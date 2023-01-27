# Blog CMS

A simple and easy-to-use content management system for creating and managing a blog, built with Laravel.

## Features
- Create, read, update, and delete (CRUD) functionality for blog posts
- User authentication and authorization
- Comment system for blog posts
- Rich text editor for creating and editing blog posts
- Responsive design for optimal viewing on any device

## Prerequisites
- PHP >= 7.2
- MySQL or other database server
- Composer

## Installation
1. Clone the repository: `git clone https://github.com/YasserElgammal/blog-cms.git`
2. Install the dependencies: `composer install`
3. Create a `.env` file in the root directory and set the following environment variables:
   - `DB_DATABASE`: the name of your database
   - `DB_USERNAME`: the username for your database
   - `DB_PASSWORD`: the password for your database
4. Run the migration command to create the necessary tables in the database: `php artisan migrate`
5. Start the development server: `php artisan serve`
6. visit `http://localhost:8000` 
