<p align="center">
<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Product CRUD Module - Trial Task (48 hrs)

## Live Demo
[https://product-crud-su89.onrender.com/](https://product-crud-su89.onrender.com/)

## Goal
Build a tiny CRUD application to manage products with authentication and basic validation.

## Features
- **Authentication:** Email and password login/register
- **Product Management:** 
  - Create product (name, price, image, description)
  - List products
  - View single product
- **Security:** CSRF protection
- **Validation:** Basic input validation for product forms
- **Tech Stack:** Laravel 10+, Eloquent ORM, migrations, seeders

Laravel Product Module - Trial Task (48 hrs)
Live Demo

https://product-crud-su89.onrender.com/

Goal

Build a tiny CRUD application to manage products with authentication and basic validation.

Features

Authentication: Email and password login/register

Product Management:

Create product (name, price, image, description)

List products

View single product

Security: CSRF protection

Validation: Basic input validation for product forms

Tech Stack: Laravel 10+, Eloquent ORM, migrations, seeders

Setup / Installation

## Setup / Installation
1. Clone the repository:
```bash
git clone https://github.com/paschal1/product-crud.git
cd <pruduct-crud>


composer install
npm install
npm run build


cp .env.example .env
php artisan key:generate


php artisan migrate --seed

php artisan serve

Access at http://127.0.0.1:8000


app/
 ├── Http/
 │    ├── Controllers/
 │    │    └── ProductController.php
 │    └── Requests/
 │         └── ProductRequest.php
 ├── Models/
 │    └── Product.php
database/
 ├── migrations/
 ├── seeders/
resources/
 ├── views/
 │    └── products/
 │         ├── index.blade.php
 │         ├── create.blade.php
 │         └── show.blade.php
routes/
 └── web.php

Deployment

Deployed on Render: live at https://product-crud-su89.onrender.com/

Notes: Make sure all assets load over HTTPS to prevent Mixed Content errors.