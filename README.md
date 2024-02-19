# Server Management System

## Table of Contents

1. [Description](#description)
2. [Installation](#installation)
3. [Usage](#usage)
4. [Testing](#testing)
5. [Contributing](#contributing)

## Description

This project is a server management system built with Laravel, Vue.js, Tailwind CSS, Vite, and MySQL. It allows users to manage servers, monitor their status, and perform various operations on them.

## Installation

To install this project, follow these steps:

1. Clone the repository:

git clone https://github.com/hasithadaffy/Server-Management-System.git

cd project

2. Install all the PHP and JS dependencies:

composer install

npm install

3. Copy the .env.example file to .env and modify the database configuration:

cp .env.example .env

and add your mysql database credentials

4. Generate an application key:

php artisan key:generate

5. Run the database migrations:

php artisan migrate

6. Run the database seeder:

php artisan db:seed ServerSeeder

## Usage

To start the application, run:

1. php artisan serve
2. npm run dev

## Testing

To run the tests for this project, use the following command:

php artisan test

## Contributing
Contributions are welcome! Please create an issue to discuss your proposed changes before submitting a pull request.


