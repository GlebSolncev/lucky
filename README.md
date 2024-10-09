# Project Overview
LuckyGame is a Laravel-based application that allows users to participate in a game called "I'm Feeling Lucky." Users can register, receive unique links, play the game by generating random numbers, and view their game history. The project follows best practices by utilizing services, repositories, DTOs (Data Transfer Objects), and comprehensive unit testing with Mockery.

## Installation

### Prerequisites
- PHP >= 8.2
- Composer (Dependency Manager for PHP)
- MySQL or another supported database(or SqLite)

### Installation
- Clone the Repository
```shell
git clone https://github.com/GlebSolncev/lucky.git
```

- Go to project src
```shell
cd lucky
```

- Install PHP Dependencies
```shell
composer install
```

- Copy the .env File
```shell
cp .env.example .env
```

- Generate Application Key
```shell
php artisan key:generate
```

- Running the Project
```shell
php artisan serve
```

- Running Tests
```shell
php artisan test
```


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
